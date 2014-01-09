<?php

namespace HtSession\Options;

interface AccessibilityOptionsInterface
{
     public function setModules(array $modules);

     public function getModules();

     public function setControllers(array $controllers);

     public function getControllers();
}
