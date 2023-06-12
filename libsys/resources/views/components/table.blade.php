<div class="table-responsive">
    <table class="table tablesorter">
        <thead class="text-primary">
            <tr>
                @foreach ($arrayHeader as $header)
                    <th class="text-center">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($arrayData as $data)
                <tr>
                    @foreach ($data as $value)
                        <td class="text-center">
                            @if (is_array($value))
                                @include('components.icon', $value)
                            @else
                                {{ $value }}
                            @endif
                        </td>
                    @endforeach
                </tr>
                @if ($data['delete'])
                    @include(
                        'components.modal_delete',
                        [
                            'userId' => $data['delete']['id'],
                            'title' => $data['delete']['title'],
                            'idModal' => substr($data['delete']['target'], 1),
                            'route' => $data['delete']['route']
                        ]
                    )
                @endif
            @endforeach
        </tbody>
    </table>
</div>
