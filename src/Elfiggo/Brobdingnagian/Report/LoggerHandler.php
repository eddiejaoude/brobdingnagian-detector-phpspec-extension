<?php

namespace Elfiggo\Brobdingnagian\Report;

use PhpSpec\Console\IO;
use ReflectionClass;

class LoggerHandler implements Handler
{

    private $log = [];

    private $io;

    public function __construct(IO $io)
    {
        $this->io = $io;
    }

    /**
     * @param ReflectionClass $sus
     * @param $class
     * @param $message
     */
    public function act(ReflectionClass $sus, $class, $message)
    {
        $errorType = null;
        $this->log[] = ['message' => $message, 'class' => $class, 'errorType' => $errorType];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return $this->log;
    }

    public function output()
    {
        $this->io->writeln('');
        $this->io->writeln('-----------------------------------------------------------------------------');
        $this->io->writeln('------------------------- Brobdingnagian Table ------------------------------');
        $this->io->writeln('-----------------------------------------------------------------------------');
        foreach($this->messages() as $data) {
            $this->io->writeln($data['errorType'] . '   |   ' . $data['message']);
        }
        $this->io->writeln('-----------------------------------------------------------------------------');
        $this->io->writeln('-----------------------------------------------------------------------------');
    }
}
