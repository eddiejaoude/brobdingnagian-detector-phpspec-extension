<?php

namespace spec\Elfiggo\Brobdingnagian\Detector;

use Elfiggo\Brobdingnagian\Exception\ClassSizeTooLarge;
use Elfiggo\Brobdingnagian\Param\Params;
use Elfiggo\Brobdingnagian\Report\Reporter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use ReflectionClass;

class ClassSizeSpec extends ObjectBehavior
{
    const LESS_THAN_300 = 299;
    const GREATER_THAN_300 = 301;

    function it_is_initializable()
    {
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\ClassSize');
        $this->shouldHaveType('Elfiggo\Brobdingnagian\Detector\DetectionInterface');
    }

    function it_does_not_complain_if_the_class_size_is_not_too_large(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $params->getClassSize()->willReturn(self::LESS_THAN_300);
        $sus->getEndLine()->willReturn(self::LESS_THAN_300);
        $this->shouldNotThrow(ClassSizeTooLarge::class)->duringCheck($sus, $params, $reporter);
    }

    function it_complains_if_class_size_is_too_large(ReflectionClass $sus, Params $params, Reporter $reporter)
    {
        $sus->getEndLine()->willReturn(self::GREATER_THAN_300);
        $params->getClassSize()->willReturn(self::LESS_THAN_300);
        $sus->getName()->willReturn("Elfiggo/Brobdingnagian/Detector/ClassSize");
        $reporter->act($sus, 'Elfiggo\Brobdingnagian\Detector\ClassSize', 'Elfiggo/Brobdingnagian/Detector/ClassSize class size is too large (301)', 'Class size')->willThrow(ClassSizeTooLarge::class);
        $this->shouldThrow(ClassSizeTooLarge::class)->duringCheck($sus, $params, $reporter);
    }
}
