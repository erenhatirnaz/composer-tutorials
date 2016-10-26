<?php

namespace AtinaLogger;

use PHPUnit_Framework_TestCase;

class LoggerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Logger
    */
    private $logger;

    /**
     * @var string
    */
    private $logDirectory = __DIR__ . DIRECTORY_SEPARATOR . "logs";

    /**
     * Her testten önce Logger nesnemizi tekrar oluşturuyoruz.
     */
    public function setUp()
    {
        $this->logger = new Logger($this->logDirectory);
    }

    /**
     * Log dosyasının başarılı bir şekilde oluşturulup oluşturulmadığı test ediyoruz.
     */
    public function testIsCreatedLogFile()
    {
        $this->assertFileExists($this->logger->getLogFilePath());
    }

    /**
     * Hatanın başarılı bir şekilde raporlanıp raporlanmadığını test ediyoruz.
     */
    public function testIsSuccessfullyErrorLoging()
    {
        $this->logger->log("error", "bu bir hatadir");
        $this->assertEquals($this->logger->getLastLine(), $this->getLastLine($this->logger->getLogFilePath()));
    }

    /**
     * Uyarının başarılı bir şekilde raporlanıp raporlanmadığını test ediyoruz.
     */
    public function testIsSuccessfullyWarningLoging()
    {
        $this->logger->log("warning", "bu bir uyaridir");
        $this->assertEquals($this->logger->getLastLine(), $this->getLastLine($this->logger->getLogFilePath()));
    }

    /**
     * Parametre olarak genel dosyanın son satırını geri döndürür. Doğrulama yapmak için yazıldı.
     *
     * @param string $filename Dosya yolu
     */
    private function getLastLine($filename)
    {
        $data = file($filename);
        return trim($data[count($data) - 1]);
    }
}
