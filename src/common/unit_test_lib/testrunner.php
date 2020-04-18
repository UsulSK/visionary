<?php


// Runs all tests in a folder
// $path: The folder which contains the tests
function runTests($path) {

   setPhpShowErrors();

?>
    <h1>Run unit tests</h1>
<?php
 
    // include all test files

    $contentOfDirectory = scandir($path);
    foreach ($contentOfDirectory as $fileOrFolder) {
        if (!preg_match('/test\.php$/', $fileOrFolder))  {
            continue;
        }

        $fullPathToTestFile = $path . '/' . $fileOrFolder;
        require_once($fullPathToTestFile); 
    }

    // search in the now declared classes for test classes and run them

    $nrOfSuccesses = 0;
    $nrOfFails = 0;
    foreach (get_declared_classes() as $knownClass) {
        $classReflection = new ReflectionClass($knownClass);
        $classComment = $classReflection->getDocComment();

        if (!preg_match('/\[TEST\]/', $classComment))  {
            continue;
        }

        runTestClass($classReflection, $nrOfSuccesses, $nrOfFails);
    }

    echo '<br><h2>Finished!</h2>';

    if( $nrOfFails==0 )
    {
        echo "<p><font color=\"green\">No failed tests!</font></p>";
    } else {
        echo "<p><b><font color=\"red\">FAILED: $nrOfFails</font></b></p>";
    }

    echo "<p><font color=\"green\">SUCCESSFULL TESTS: $nrOfSuccesses</font></p>";
}

function runTestClass($testClass, &$nrOfSuccesses, &$nrOfFails) {
    echo '<h2>Run: <i>' . $testClass->getName() . '</i></h2>';

    $beforeClassMethod = null;
    $beforeMethod = null;
    $testMethods = array();

    $methods = $testClass->getMethods();
    foreach ($methods as $method) {
        $methodComment = $method->getDocComment();

        if (preg_match('/\[BEFORE\]/', $methodComment))  {
            $beforeMethod = $method;
        }
        else if (preg_match('/\[BEFORECLASS\]/', $methodComment))  {
            $beforeClassMethod = $method;
        }
        else if (preg_match('/\[TEST\]/', $methodComment))  {
            $testMethods[] = $method;
        }
    }

    $testObject = $testClass->newInstance();
    if( $beforeClassMethod != null ) {
        $beforeClassMethod->invoke($testObject);
    }
    foreach ($testMethods as $testMethod) {
        echo '<p><b>Run <i>' . $testMethod->getName() . '</i></b></p>';

        if( $beforeMethod != null ) {
            $beforeMethod->invoke($testObject);
        }

        $success = true;
        try {
            $testMethod->invoke($testObject);
        } catch (Exception $error) {
            $success = false;
            echo '<p><b><font color="red">Test Failed:<br>' . $error->getMessage() . '</font></b></p>';
        }

        if($success) {
            echo '<p><b><font color="green">SUCCESS</font></b></p>';
            $nrOfSuccesses++;
        }
        else {
            $nrOfFails++;
        }
    }

}

// Configure PHP to show as many errors as it can to help debugging
function setPhpShowErrors() {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

function convertValueToString($value) {
    if( is_bool($value) )
    {
        if( $value==true )
        {
            return 'true';
        }
        
        return 'false';
    }

    if( is_object($value) ) {
        return 'instance of ' . get_class($value);
    }

    return $value;
}

function testAssertEquals($valueToCheck, $expectedValue, $message) {
    echo "<p>Checking: $message</p>";

    if($valueToCheck === $expectedValue) {
        echo "<p>check was successfull</p>";
        return;
    }

    $valueToCheckString = convertValueToString($valueToCheck);
    $expectedValueString = convertValueToString($expectedValue);
    $errorMessage = "Check failed while checking \"$message\"! <br>Expected value \"$expectedValueString\", got value \"$valueToCheckString\"!";
    echo "<p>$errorMessage</p>";

    throw new Exception($errorMessage);
}

function testAssertNull($valueToCheck, $message) {
    echo "<p>Checking: $message</p>";

    if( !is_null($valueToCheck) ) {
        $valueToCheckString = convertValueToString($valueToCheck);
        $errorMessage = "Check failed while checking \"$message\"! <br>Expected value to be \"null\", but was \"$valueToCheckString\"!";
        echo "<p>$errorMessage</p>";

        throw new Exception($errorMessage);
    }

    echo "<p>check was successfull</p>";
}

function testAssertNotNull($valueToCheck, $message) {
    echo "<p>Checking: $message</p>";

    if( !isset($valueToCheck) || is_null($valueToCheck) ) {
        $errorMessage = "Check failed while checking \"$message\"! <br>Expected a value but was \"null\" or not set!";
        echo "<p>$errorMessage</p>";

        throw new Exception($errorMessage);
    }

    echo "<p>check was successfull</p>";
}

function testAssertTrue($booleanToCheck, $message) {
    echo "<p>Checking: $message</p>";

    if( $booleanToCheck===true ) {
        echo "<p>check was successfull</p>";
    } else {
        $booleanString = convertValueToString($booleanToCheck);
        $errorMessage = "Check failed while checking \"$message\"! <br>Expected value <i>true</i>, got value <i>$booleanString</i>!";
        echo "<p>$errorMessage</p>";

        throw new Exception($errorMessage);
    }
}

function testFail($message) {
    throw new Exception('Failed test because: ' . $message);
}

function testLog($logMessage) {
    echo "<p>$logMessage</p>";
}

?>