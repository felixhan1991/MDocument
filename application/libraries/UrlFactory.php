<?php
/**
 * Singleton class
 *
 */
final class UrlFactory 
{
    /**
     * Call this method to get singleton
     *
     * @return UserFactory
     */
    private $hostName;
    private $protocol;
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new UrlFactory();
        }
        return $inst;
    }

    /**
     * Private ctor so nobody else can instance it
     *
     */
    private function __construct()
    {
        $data = explode('/',base_url());
        $this->hostName = $data[2];
        $this->protocol = $data[0].'//';
        
    }
    
    public  function getHostName()
    {
        return $this->hostName;
    }
    
    public  function getProtocol()
    {
        return $this->protocol;
    }
    
}

?>