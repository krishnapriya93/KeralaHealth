@if($offices->isNotEmpty())
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Office Name</th>
                <th>Department Fields</th>
                <th>Categories</th>
                <th>Submenu</th>
            </tr>
        </thead>

        <tbody>
            @foreach($offices as $index => $office)
                <tr data-office-id="{{ $office->id }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $office->office_sub[0]->title ?? '' }}</td>
                    <td>
                        @foreach($office->departmentfields ?? [] as $field)
                            @foreach($field->depfd_sub as $depfd_sub)
                                {{ $depfd_sub->title }}<br>
                            @endforeach
                        @endforeach
                    </td>
                    <td>
                        @foreach($office->departmentcat ?? [] as $category)
                            @foreach($category->depcat_sub as $depcat_sub)
                                {{ $depcat_sub->title }}<br>
                            @endforeach
                        @endforeach
                    </td>
                    <td>
    <!-- <input type="radio" name="officesubmenu" value="{{ $office->id }}" />
    <div class="dropdown-container mt-2" style="display: none;"></div> -->
</td>

                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p>No office details available.</p>
@endif
