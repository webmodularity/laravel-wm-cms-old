<tr>
    <td data-order="{{ $logUser->created_at->format('U') }}" data-sort="{{ $logUser->created_at->format('U') }}">
        {{ $logUser->created_at->format('m/d/Y h:i:sa') }}
    </td>
    <td>{{ $logUser->user->person->email }}</td>
    <td>{{ $logUser->logRequest->ipAddress->ip_address }}</td>
    <td>
        @if($logUser->user_action == \WebModularity\LaravelUser\LogUser::ACTION_LOGIN)
            <span class="label label-success">Login</span>
        @elseif($logUser->user_action == \WebModularity\LaravelUser\LogUser::ACTION_LOGOUT)
            <span class="label label-default">Logout</span>
        @elseif($logUser->user_action == \WebModularity\LaravelUser\LogUser::ACTION_REGISTER)
            <span class="label label-primary">Register</span>
        @elseif($logUser->user_action == \WebModularity\LaravelUser\LogUser::ACTION_LINK_SOCIAL)
            <span class="label label-info">Link Social</span>
        @endif()
    </td>
    <td>{{ $logUser->logRequest->urlPath->url_path }}</td>
</tr>