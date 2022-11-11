<?php
namespace Logger\Handlers;

class FakeHandler extends Handler
{
    public function __construct(array $options = null)
    {
        $options = ['is_enabled' => true];
        parent::__construct(['is_enabled' => true]);
    }
}