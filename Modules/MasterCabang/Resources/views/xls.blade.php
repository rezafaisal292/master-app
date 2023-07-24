
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Kode Cabang</th>
              <th>Nama Cabang</th>
              <th>Cabang Induk</th>
              <th>Kanwil</th>
              <th>Status</th>
              <th>Time Stamp</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($data as $d)
            <tr>
              <td>{{$d->kodecabang}}</td>
              <td>{{$d->namacabang}}</td>
              <td>{{$d->kodeinduk}}  - {{$d->induk == null ? '-' :$d->induk->namacabang}}</td>
              <td>{{$d->kodekanwil}} - {{$d->wilayah == null ? '-' :$d->wilayah->namacabang}}</td>
              <td>{{$status[$d->status]}}</td>
              <td>{{$d->updated_at}}</td>
            </tr>
            @endforeach 
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      
