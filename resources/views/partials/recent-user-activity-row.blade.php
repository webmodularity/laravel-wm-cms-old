<tr>
    <td data-order="{{ $logUser->created_at->format('U') }}" data-sort="{{ $logUser->created_at->format('U') }}">
        {{ $logUser->created_at->format('m/d/Y h:i:sa') }}
    </td>
    <td>{{ $logUser->user->person->email }}</td>
    <td>{{ $logUser->logRequest->ipAddress->ip }}</td>
    <td>{{ $logUser->userAction->action }}</td>
    <td>{{ $logUser->logRequest->urlPath->url_path }}</td>
</tr>