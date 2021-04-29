<?php

// namespace Design\Dependency;

class DatabaseConnection
{
    /**
     * @var DatabaseConfiguration
     */
    private $configration;

    /**
     * @param DatabaseConfiguration $config
     */
    public function __construct(DatabaseConfiguration $config)
    {
        $this->configration = $config;
    }

    public function getDsn(): string
    {

        return sprintf(
            '%s:%s:@%s:%d',
            $this->configration->getUsername(),
            $this->configration->getPassword(),
            $this->configration->getHost(),
            $this->configration->getPort()
        );
    }
}
