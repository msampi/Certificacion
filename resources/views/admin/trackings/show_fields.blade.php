<table class="table table-bordered">
    <thead>
        <th>Navegador</th>
        <th>IP</th>
        <th>Acción</th>
        <th>Fecha y Hora</th>

    </thead>
    <tbody>
      @foreach ($tracking->actions as $action)
        <tr>
          <td>{!! $action->browser !!}</td>
          <td>{!! $action->ip !!}</td>
          <td>{!! $action->action !!}</td>
          <td>{!! $action->created_at !!}</td>
        </tr>

      @endforeach
    </tbody>
</table>
