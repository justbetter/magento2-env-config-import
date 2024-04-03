<?php

namespace JustBetter\EnvConfigImport\Plugin\Config\Model\Config;

use JustBetter\EnvConfigImport\Plugin\BasePlugin;
use Magento\Config\Model\Config\Importer;

class ImporterPlugin extends BasePlugin
{
    public function beforeImport(Importer $subject, array $data) : array
    {
        $data = $this->getConfigFromEnv($data);
        return [$data];
    }
}
