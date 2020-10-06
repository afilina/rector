<?php
declare(strict_types=1);

namespace Rector\Core\Tests\Application;

use Rector\ChangesReporting\Application\ErrorAndDiffCollector;
use Rector\Core\Application\RectorApplication;
use Rector\Core\HttpKernel\RectorKernel;
use Symplify\PackageBuilder\Tests\AbstractKernelTestCase;
use Symplify\SmartFileSystem\SmartFileInfo;

final class RectorApplicationTest extends AbstractKernelTestCase
{
    /** @test */
    public function runOnFileInfos_WithStaticReflection_Automatically(): void
    {
        chdir(__DIR__ . '/Source/StaticReflection');
        $this->bootKernelWithConfigs(RectorKernel::class, [
            __DIR__ . '/Source/StaticReflection/rector.php' // phpstan.neon will be detected automatically
        ]);

        $rectorApplication = self::$container->get(RectorApplication::class);
        $rectorApplication->runOnFileInfos([
            new SmartFileInfo(__DIR__ . '/Source/StaticReflection/src/MyClass.php')
        ]);

        $errorAndDiffCollector = self::$container->get(ErrorAndDiffCollector::class);
        self::assertEmpty(
            $errorAndDiffCollector->getErrors()
        );
    }
}
