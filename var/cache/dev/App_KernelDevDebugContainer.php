<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerTyyZlrT\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerTyyZlrT/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerTyyZlrT.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerTyyZlrT\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerTyyZlrT\App_KernelDevDebugContainer([
    'container.build_hash' => 'TyyZlrT',
    'container.build_id' => '2bbe631e',
    'container.build_time' => 1614443206,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerTyyZlrT');
