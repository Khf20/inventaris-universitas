<?php

use App\Models\User;

test('user role can identify administrators', function () {
    expect((new User(['role' => 'admin']))->isAdmin())->toBeTrue()
        ->and((new User(['role' => 'staff']))->isAdmin())->toBeFalse();
});
