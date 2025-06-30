@extends('frontend.layouts.main_header')

@section('content')

<div class="page-wrapper pbmit-bg-color-light">

    @include('frontend.layouts.main_menu')

    <!-- <div class="pbmit-title-bar-wrapper article_bg">
        <div class="container">
            <h1 class="pbmit-tbar-title">Financial Aid</h1>
        </div>
    </div> -->

    <div class="page-content">
        <section class="site_content blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">

                        <div class="container my-4">
                            <div id="kaleidoscopeChart" style="height: 700px; border: 1px solid #ccc; border-radius: 8px;"></div>
                        </div>

                        <!-- Modal to show institution details -->
                        <div class="modal fade" id="institutionModal" tabindex="-1" aria-labelledby="institutionModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="institutionModalLabel">Institution Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-center" id="institutionModalBody">
                                        <!-- Content dynamically inserted -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    @include('frontend.layouts.main_footer')

</div>

@include('frontend.layouts.search_scroll')
@include('frontend.layouts.include_scripts')

<!-- Vis.js -->
<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<link href="https://unpkg.com/vis-network/styles/vis-network.min.css" rel="stylesheet" />

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const container = document.getElementById('kaleidoscopeChart');
    const institutionImgUrl = "{{ asset('assets/frontend/images/insitution.png') }}";

    // Initial nodes passed from controller (make sure you pass $nodes to blade!)
    const initialNodes = {!! json_encode($nodes) !!}.map(node => {
        const isDistrict = node.type === 'district';
        const isInstitution = node.type === 'institution';
        const isCategory = node.type === 'category';

        return {
            ...node,
            shape: isInstitution ? 'image' : 'circle',
            image: isInstitution ? institutionImgUrl : undefined,
            size: isDistrict ? 60 : isCategory ? 40 : 30,
            color: isDistrict
                ? {
                    border: '#0047b3',
                    background: '#1e90ff',
                    highlight: { border: '#002d72', background: '#3ea0ff' },
                    hover: { border: '#001f4d', background: '#5ab0ff' }
                }
                : isCategory
                ? {
                    border: '#ffa726',
                    background: '#fff3e0',
                    highlight: { border: '#fb8c00', background: '#ffcc80' },
                    hover: { border: '#ef6c00', background: '#ffe0b2' }
                }
                : {
                    border: '#43a047',
                    background: '#ffffff',
                    highlight: { border: '#2e7d32', background: '#a5d6a7' },
                    hover: { border: '#1b5e20', background: '#c8e6c9' }
                },
            font: {
                color: isDistrict ? '#fff' : '#000',
                size: isDistrict ? 18 : (isCategory ? 16 : 14),
                bold: isDistrict || isCategory
            },
            label: !isInstitution ? node.label : undefined,
            title: isInstitution ? node.label : undefined,
            details: node.details || null
        };
    });

    const nodes = new vis.DataSet(initialNodes);
    const edges = new vis.DataSet([]);

    const data = { nodes, edges };

    const options = {
        layout: { improvedLayout: true, hierarchical: false },
        physics: {
            enabled: true,
            barnesHut: {
                gravitationalConstant: -6000,
                centralGravity: 0.4,
                springLength: 60,
                springConstant: 0.04
            }
        },
        interaction: { hover: true, navigationButtons: true },
        nodes: {
            borderWidth: 3,
            shadow: { enabled: true, color: 'rgba(0,0,0,0.3)', size: 15, x: 0, y: 5 }
        }
    };

    const network = new vis.Network(container, data, options);

    network.on('click', function(params) {
        if (params.nodes.length > 0) {
            const clickedNode = nodes.get(params.nodes[0]);

            if (clickedNode.type === 'institution') {
                showInstitutionModal(clickedNode);
            } else {
                fetchChildren(clickedNode.id, clickedNode.type);
            }
        }
    });

    function showInstitutionModal(node) {
        alert(node.label);
        const body = document.getElementById('institutionModalBody');

        const imageHtml = `<img src="${institutionImgUrl}" class="img-fluid rounded mb-3" alt="${node.label}" style="max-height:150px;">`;
        const nameHtml = `<h5>${node.label}</h5>`;
        const detailsHtml = node.details ? `<p>${node.details}</p>` : '';

        body.innerHTML = `${imageHtml}${nameHtml}${detailsHtml}`;

        const modal = new bootstrap.Modal(document.getElementById('institutionModal'));
        modal.show();
    }

function fetchChildren(id, type) {
    fetch("{{ route('main.kaleidoscope.children') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        body: JSON.stringify({ id: id, type: type })
    })
    .then(response => response.json())
    .then(data => {
        if (data.nodes.length === 0) {
            // Add temporary "No data found" node
            const tempId = 'no_data_' + id;
            if (!nodes.get(tempId)) {
                nodes.add({
                    id: tempId,
                    label: "No data found",
                    level: 999,
                    type: 'info',
                    shape: 'box',
                    color: {
                        border: '#b71c1c',
                        background: '#ffcdd2',
                        highlight: { border: '#d32f2f', background: '#ef9a9a' },
                        hover: { border: '#c62828', background: '#e57373' }
                    },
                    font: {
                        color: '#b71c1c',
                        bold: true
                    }
                });
                edges.add({
                    from: id,
                    to: tempId
                });

                // Auto-remove the message after 3 seconds
                setTimeout(() => {
                    if (nodes.get(tempId)) {
                        nodes.remove(tempId);
                    }
                }, 3000);
            }
            return;
        }

        // Add new nodes and edges
        data.nodes.forEach(n => {
            if (!nodes.get(n.id)) {
                const isDistrict = n.type === 'district';
                const isInstitution = n.type === 'institution';
                const isCategory = n.type === 'category';

                nodes.add({
                    ...n,
                    shape: isInstitution ? 'image' : 'circle',
                    image: isInstitution ? institutionImgUrl : undefined,
                    size: isDistrict ? 60 : isCategory ? 40 : 30,
                    color: isDistrict
                        ? {
                            border: '#0047b3',
                            background: '#1e90ff',
                            highlight: { border: '#002d72', background: '#3ea0ff' },
                            hover: { border: '#001f4d', background: '#5ab0ff' }
                        }
                        : isCategory
                        ? {
                            border: '#ffa726',
                            background: '#fff3e0',
                            highlight: { border: '#fb8c00', background: '#ffcc80' },
                            hover: { border: '#ef6c00', background: '#ffe0b2' }
                        }
                        : {
                            border: '#43a047',
                            background: '#ffffff',
                            highlight: { border: '#2e7d32', background: '#a5d6a7' },
                            hover: { border: '#1b5e20', background: '#c8e6c9' }
                        },
                    font: {
                        color: isDistrict ? '#fff' : '#000',
                        size: isDistrict ? 18 : (isCategory ? 16 : 14),
                        bold: isDistrict || isCategory
                    },
                    label: !isInstitution ? n.label : undefined,
                    title: isInstitution ? n.label : undefined,
                    details: n.details || null
                });
            }
        });

        data.edges.forEach(e => {
            if (!edges.get({ filter: edge => edge.from === e.from && edge.to === e.to }).length) {
                edges.add(e);
            }
        });

    })
    .catch(err => {
        console.error('Error fetching children:', err);
    });
}


</script>

@endsection
