<?php

class UserCreated
{
    public function handle($event)
    {
        $user = $event->user;
        $user->account()->create([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
