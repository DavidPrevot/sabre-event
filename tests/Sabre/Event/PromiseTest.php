<?php

namespace Sabre\Event;

class PromiseTest extends \PHPUnit_Framework_TestCase {

    function testPromiseSuccess() {

        $finalValue = 0;
        $promise = new Promise();
        $promise->fulfill(1);

        $promise->then(function($value) use (&$finalValue) {
            $finalValue=$value + 2;
        });

        $this->assertEquals(3, $finalValue);

    }

    function testPromiseFail() {

        $finalValue = 0;
        $promise = new Promise();
        $promise->reject(1);

        $promise->then(null, function($value) use (&$finalValue) {
            $finalValue=$value + 2;
        });

        $this->assertEquals(3, $finalValue);

    }

    function testPromiseChain() {

        $finalValue = 0;
        $promise = new Promise();
        $promise->fulfill(1);

        $promise->then(function($value) use (&$finalValue) {
            $finalValue=$value + 2;
            return $finalValue;
        })->then(function($value) use (&$finalValue) {
            $finalValue = $value + 4;
            return $finalValue; 
        });

        $this->assertEquals(7, $finalValue);


    }

}