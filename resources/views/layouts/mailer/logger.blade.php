<table class="email-wraper">
    <tbody>
    <tr>
        <td class="py-5">
            <table class="email-body">
                <tbody>
                <tr>
                    <td class="p-3 p-sm-5">
                        <p><strong>{{ $name }}</strong>, {{{ __($description) }}}</p>
                        <p class="mt-4">---- <br> {{ env('APP_NAME') }}</p>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>