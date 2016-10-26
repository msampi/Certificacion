<table class="table table-bordered">
    <thead>
        <th>{!! $dictionary->translate('Navegador') !!}</th>
        <th>{!! $dictionary->translate('IP') !!}</th>
        <th>{!! $dictionary->translate('Acción') !!}</th>
        <th>{!! $dictionary->translate('Fecha y Hora') !!}</th>

    </thead>
    <tbody>
      @foreach ($tracking->actions as $action)
        <tr>
          <td>{!! $action->browser !!}</td>
          <td>{!! $action->ip !!}</td>
          <td>{!! $action->getAttributeTranslate($action->action) !!}</td>
          <td>{!! $action->created_at !!}</td>
        </tr>

      @endforeach
    </tbody>
</table>
