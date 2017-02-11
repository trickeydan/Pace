<div class="container">
    <div class="well">
        <h1 class="text-center">My Points</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Date Awarded</th>
                    <th>Awarded by</th>
                    <th>Category </th>
                    <th>Amount </th>
                    <th>Description </th>
                </tr>
                </thead>
                <tbody>
                @if($points->count() > 0)
                    @foreach($points as $point)
                        <tr>
                            <td>{{$point->date}}</td>
                            <td>{{$point->teacher}}</td>
                            <td>{{$point->type}}</td>
                            <td>{{$point->amount}}</td>
                            <td>{{$point->description}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <p>There are no points to display</p>
                        </td>
                    </tr>

                @endif
                </tbody>
            </table>
        </div>
        <nav class="text-center">
            {{$points->links()}}
        </nav>
        <p class="text-muted text-center small">Last Updated on {{\App\System::lastUpdated()}}</p>
    </div>
</div>