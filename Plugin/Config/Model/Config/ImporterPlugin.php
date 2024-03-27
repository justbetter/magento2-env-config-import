<?php

namespace JustBetter\EnvConfigImport\Plugin\Config\Model\Config;

use JustBetter\EnvConfigImport\Plugin\Base;
use Magento\Config\Model\Config\Importer;

class ImporterPlugin  extends Base
{
    public function beforeImport(Importer $subject, array $data) : array
    {
        $data = $this->getConfigFromEnv($data);
        return [$data];
    }
}
