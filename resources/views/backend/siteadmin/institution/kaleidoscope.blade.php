@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!! $breadcrumbarr !!}
    </ol>
</nav>

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
@endsection

@section('page_scripts')
<!-- Vis Network -->
<script src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"></script>
<link href="https://unpkg.com/vis-network/styles/vis-network.min.css" rel="stylesheet" />

<!-- Bootstrap 5 JS for modal -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const container = document.getElementById('kaleidoscopeChart');

    const institutionImgUrl = "{{ asset('assets/frontend/images/insitution.png') }}";

    // District nodes will have a blue radial gradient effect using shadow and brighter border
    // Nodes style:
    const initialNodes = {!! json_encode($nodes) !!}.map(node => {
        const isDistrict = node.type === 'district';
        const isInstitution = node.type === 'institution';

        return {
            ...node,
            shape: isInstitution ? 'image' : 'circle',
            image: isInstitution ? institutionImgUrl : undefined,
            size: isDistrict ? 60 : 30,
            color: isDistrict
                ? {
                    border: '#0047b3',
                    background: '#1e90ff',
                    highlight: {
                        border: '#002d72',
                        background: '#3ea0ff'
                    },
                    hover: {
                        border: '#001f4d',
                        background: '#5ab0ff'
                    }
                }
                : {
                    border: '#43a047',
                    background: '#ffffff',
                    highlight: {
                        border: '#2e7d32',
                        background: '#a5d6a7'
                    },
                    hover: {
                        border: '#1b5e20',
                        background: '#c8e6c9'
                    }
                },
            font: {
                color: isDistrict ? '#fff' : '#000',
                size: isDistrict ? 18 : 14,
                bold: isDistrict
            },
            label: isDistrict ? node.label : undefined,
            title: isInstitution ? node.label : undefined
        };
    });

    const nodes = new vis.DataSet(initialNodes);
    const edges = new vis.DataSet([]);

    const data = { nodes, edges };

    const options = {
        layout: {
            improvedLayout: true,
            // Decrease spacing between nodes
            hierarchical: false
        },
        physics: {
            enabled: true,
            barnesHut: {
                gravitationalConstant: -6000, // less negative to pull nodes closer
                centralGravity: 0.4,
                springLength: 60, // smaller spring length to reduce distance
                springConstant: 0.04
            }
        },
        interaction: {
            hover: true,
            navigationButtons: true
        },
        nodes: {
            borderWidth: 3,
            shadow: {
                enabled: true,
                color: 'rgba(0, 0, 0, 0.3)',
                size: 15,
                x: 0,
                y: 5
            }
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
        const body = document.getElementById('institutionModalBody');

        const imageHtml = `<img src="${institutionImgUrl}" class="img-fluid rounded mb-3" alt="${node.label}" style="max-height:150px;">`;
        const nameHtml = `<h5>${node.label}</h5>`;
        const detailsHtml = node.details ? `<p>${node.details}</p>` : '';

        body.innerHTML = `${imageHtml}${nameHtml}${detailsHtml}`;

        const modal = new bootstrap.Modal(document.getElementById('institutionModal'));
        modal.show();
    }

    function fetchChildren(id, type) {
        fetch("{{ route('kaleidoscope.children') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ id: id, type: type })
        })
        .then(response => response.json())
        .then(data => {
            data.nodes.forEach(n => {
                if (!nodes.get(n.id)) {
                    nodes.add({
                        ...n,
                        shape: n.type === 'institution' ? 'image' : 'circle',
                        image: n.type === 'institution' ? institutionImgUrl : undefined,
                        size: n.type === 'district' ? 30 : 10,
                        color: n.type === 'district'
                            ? {
                                border: '#0047b3',
                                background: '#1e90ff',
                                highlight: {
                                    border: '#002d72',
                                    background: '#3ea0ff'
                                },
                                hover: {
                                    border: '#001f4d',
                                    background: '#5ab0ff'
                                }
                            }
                            : {
                                border: '#43a047',
                                background: '#ffffff',
                                highlight: {
                                    border: '#2e7d32',
                                    background: '#a5d6a7'
                                },
                                hover: {
                                    border: '#1b5e20',
                                    background: '#c8e6c9'
                                }
                            },
                        font: {
                            color: n.type === 'district' ? '#fff' : '#000',
                            size: n.type === 'district' ? 18 : 14,
                            bold: n.type === 'district'
                        },
                        label: n.type === 'district' ? n.label : undefined,
                        title: n.type === 'institution' ? n.label : undefined
                    });
                }
            });

            data.edges.forEach(e => {
                const exists = edges.get({
                    filter: edge => edge.from === e.from && edge.to === e.to
                }).length;
                if (!exists) {
                    edges.add(e);
                }
            });
        })
        .catch(err => console.error('Fetch error:', err));
    }
</script>
@endsection
