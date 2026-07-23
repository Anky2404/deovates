<?php declare(strict_types = 1);

// osfsl-F:/xampp/htdocs/testproject/vendor/composer/../laravel/telescope/src/Telescope.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Laravel\Telescope\Telescope
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-9fd98522f52de098757e2aadd2046a69b5bd7c3249f9ff934af5adb1ebc32ac6-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Laravel\\Telescope\\Telescope',
        'filename' => 'F:/xampp/htdocs/testproject/vendor/composer/../laravel/telescope/src/Telescope.php',
      ),
    ),
    'namespace' => 'Laravel\\Telescope',
    'name' => 'Laravel\\Telescope\\Telescope',
    'shortName' => 'Telescope',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 22,
    'endLine' => 873,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'Laravel\\Telescope\\AuthorizesRequests',
      1 => 'Laravel\\Telescope\\ExtractsMailableTags',
      2 => 'Laravel\\Telescope\\ListensForStorageOpportunities',
      3 => 'Laravel\\Telescope\\RegistersWatchers',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'filterUsing' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'filterUsing',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 34,
            'endLine' => 34,
            'startTokenPos' => 117,
            'startFilePos' => 874,
            'endTokenPos' => 118,
            'endFilePos' => 875,
          ),
        ),
        'docComment' => '/**
 * The callbacks that filter the entries that should be recorded.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 34,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 36,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'filterBatchUsing' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'filterBatchUsing',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 41,
            'endLine' => 41,
            'startTokenPos' => 131,
            'startFilePos' => 1028,
            'endTokenPos' => 132,
            'endFilePos' => 1029,
          ),
        ),
        'docComment' => '/**
 * The callbacks that filter the batches that should be recorded.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 41,
        'endLine' => 41,
        'startColumn' => 5,
        'endColumn' => 41,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'afterRecordingHook' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'afterRecordingHook',
        'modifiers' => 17,
        'type' => NULL,
        'default' => NULL,
        'docComment' => '/**
 * The callback executed after queuing a new entry.
 *
 * @var \\Closure
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 48,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 38,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'afterStoringHooks' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'afterStoringHooks',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 55,
            'endLine' => 55,
            'startTokenPos' => 154,
            'startFilePos' => 1313,
            'endTokenPos' => 155,
            'endFilePos' => 1314,
          ),
        ),
        'docComment' => '/**
 * The callbacks executed after storing the entries.
 *
 * @var \\Closure
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 55,
        'endLine' => 55,
        'startColumn' => 5,
        'endColumn' => 42,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'tagUsing' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'tagUsing',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 62,
            'endLine' => 62,
            'startTokenPos' => 168,
            'startFilePos' => 1444,
            'endTokenPos' => 169,
            'endFilePos' => 1445,
          ),
        ),
        'docComment' => '/**
 * The callbacks that add tags to the record.
 *
 * @var \\Closure[]
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 62,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 33,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'entriesQueue' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'entriesQueue',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 69,
            'endLine' => 69,
            'startTokenPos' => 182,
            'startFilePos' => 1572,
            'endTokenPos' => 183,
            'endFilePos' => 1573,
          ),
        ),
        'docComment' => '/**
 * The list of queued entries to be stored.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 69,
        'endLine' => 69,
        'startColumn' => 5,
        'endColumn' => 37,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'updatesQueue' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'updatesQueue',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 76,
            'endLine' => 76,
            'startTokenPos' => 196,
            'startFilePos' => 1693,
            'endTokenPos' => 197,
            'endFilePos' => 1694,
          ),
        ),
        'docComment' => '/**
 * The list of queued entry updates.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 76,
        'endLine' => 76,
        'startColumn' => 5,
        'endColumn' => 37,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'hiddenRequestHeaders' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'hiddenRequestHeaders',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'authorization\', \'php-auth-pw\']',
          'attributes' => 
          array (
            'startLine' => 83,
            'endLine' => 86,
            'startTokenPos' => 210,
            'startFilePos' => 1824,
            'endTokenPos' => 218,
            'endFilePos' => 1878,
          ),
        ),
        'docComment' => '/**
 * The list of hidden request headers.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 83,
        'endLine' => 86,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'hiddenRequestParameters' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'hiddenRequestParameters',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[\'password\', \'password_confirmation\']',
          'attributes' => 
          array (
            'startLine' => 93,
            'endLine' => 96,
            'startTokenPos' => 231,
            'startFilePos' => 2014,
            'endTokenPos' => 239,
            'endFilePos' => 2073,
          ),
        ),
        'docComment' => '/**
 * The list of hidden request parameters.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 93,
        'endLine' => 96,
        'startColumn' => 5,
        'endColumn' => 6,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'hiddenResponseParameters' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'hiddenResponseParameters',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => '[]',
          'attributes' => 
          array (
            'startLine' => 103,
            'endLine' => 103,
            'startTokenPos' => 252,
            'startFilePos' => 2211,
            'endTokenPos' => 253,
            'endFilePos' => 2212,
          ),
        ),
        'docComment' => '/**
 * The list of hidden response parameters.
 *
 * @var array
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 103,
        'endLine' => 103,
        'startColumn' => 5,
        'endColumn' => 49,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'ignoreFrameworkEvents' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'ignoreFrameworkEvents',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'true',
          'attributes' => 
          array (
            'startLine' => 110,
            'endLine' => 110,
            'startTokenPos' => 266,
            'startFilePos' => 2368,
            'endTokenPos' => 266,
            'endFilePos' => 2371,
          ),
        ),
        'docComment' => '/**
 * Indicates if Telescope should ignore events fired by Laravel.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 110,
        'endLine' => 110,
        'startColumn' => 5,
        'endColumn' => 48,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'useDarkTheme' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'useDarkTheme',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 117,
            'endLine' => 117,
            'startTokenPos' => 279,
            'startFilePos' => 2506,
            'endTokenPos' => 279,
            'endFilePos' => 2510,
          ),
        ),
        'docComment' => '/**
 * Indicates if Telescope should use the dark theme.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 117,
        'endLine' => 117,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'shouldRecord' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'name' => 'shouldRecord',
        'modifiers' => 17,
        'type' => NULL,
        'default' => 
        array (
          'code' => 'false',
          'attributes' => 
          array (
            'startLine' => 124,
            'endLine' => 124,
            'startTokenPos' => 292,
            'startFilePos' => 2641,
            'endTokenPos' => 292,
            'endFilePos' => 2645,
          ),
        ),
        'docComment' => '/**
 * Indicates if Telescope should record entries.
 *
 * @var bool
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 124,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 40,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
    ),
    'immediateMethods' => 
    array (
      'start' => 
      array (
        'name' => 'start',
        'parameters' => 
        array (
          'app' => 
          array (
            'name' => 'app',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 132,
            'endLine' => 132,
            'startColumn' => 34,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Register the Telescope watchers and start recording if necessary.
 *
 * @param  \\Illuminate\\Foundation\\Application  $app
 * @return void
 */',
        'startLine' => 132,
        'endLine' => 148,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'runningWithinOctane' => 
      array (
        'name' => 'runningWithinOctane',
        'parameters' => 
        array (
          'app' => 
          array (
            'name' => 'app',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 156,
            'endLine' => 156,
            'startColumn' => 51,
            'endColumn' => 54,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if Telescope is running within Octane.
 *
 * @param  \\Illuminate\\Foundation\\Application  $app
 * @return bool
 */',
        'startLine' => 156,
        'endLine' => 159,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'runningApprovedArtisanCommand' => 
      array (
        'name' => 'runningApprovedArtisanCommand',
        'parameters' => 
        array (
          'app' => 
          array (
            'name' => 'app',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 167,
            'endLine' => 167,
            'startColumn' => 61,
            'endColumn' => 64,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the application is running an approved command.
 *
 * @param  \\Illuminate\\Foundation\\Application  $app
 * @return bool
 */',
        'startLine' => 167,
        'endLine' => 186,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'handlingApprovedRequest' => 
      array (
        'name' => 'handlingApprovedRequest',
        'parameters' => 
        array (
          'app' => 
          array (
            'name' => 'app',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 194,
            'endLine' => 194,
            'startColumn' => 55,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the application is handling an approved request.
 *
 * @param  \\Illuminate\\Foundation\\Application  $app
 * @return bool
 */',
        'startLine' => 194,
        'endLine' => 202,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'requestIsToApprovedDomain' => 
      array (
        'name' => 'requestIsToApprovedDomain',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 210,
            'endLine' => 210,
            'startColumn' => 57,
            'endColumn' => 64,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'bool',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the request is to an approved domain.
 *
 * @param  \\Illuminate\\Http\\Request  $request
 * @return bool
 */',
        'startLine' => 210,
        'endLine' => 214,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'requestIsToApprovedUri' => 
      array (
        'name' => 'requestIsToApprovedUri',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 222,
            'endLine' => 222,
            'startColumn' => 54,
            'endColumn' => 61,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if the request is to an approved URI.
 *
 * @param  \\Illuminate\\Http\\Request  $request
 * @return bool
 */',
        'startLine' => 222,
        'endLine' => 241,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'startRecording' => 
      array (
        'name' => 'startRecording',
        'parameters' => 
        array (
          'loadMonitoredTags' => 
          array (
            'name' => 'loadMonitoredTags',
            'default' => 
            array (
              'code' => 'true',
              'attributes' => 
              array (
                'startLine' => 249,
                'endLine' => 249,
                'startTokenPos' => 804,
                'startFilePos' => 6241,
                'endTokenPos' => 804,
                'endFilePos' => 6244,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 249,
            'endLine' => 249,
            'startColumn' => 43,
            'endColumn' => 67,
            'parameterIndex' => 0,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Start recording entries.
 *
 * @param  bool  $loadMonitoredTags
 * @return void
 */',
        'startLine' => 249,
        'endLine' => 264,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'stopRecording' => 
      array (
        'name' => 'stopRecording',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Stop recording entries.
 *
 * @return void
 */',
        'startLine' => 271,
        'endLine' => 274,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'withoutRecording' => 
      array (
        'name' => 'withoutRecording',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 282,
            'endLine' => 282,
            'startColumn' => 45,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Execute the given callback without recording Telescope entries.
 *
 * @param  callable  $callback
 * @return mixed
 */',
        'startLine' => 282,
        'endLine' => 293,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'isRecording' => 
      array (
        'name' => 'isRecording',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Determine if Telescope is recording.
 *
 * @return bool
 */',
        'startLine' => 300,
        'endLine' => 303,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'record' => 
      array (
        'name' => 'record',
        'parameters' => 
        array (
          'type' => 
          array (
            'name' => 'type',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'string',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 312,
            'endLine' => 312,
            'startColumn' => 38,
            'endColumn' => 49,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 312,
            'endLine' => 312,
            'startColumn' => 52,
            'endColumn' => 71,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  string  $type
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 312,
        'endLine' => 339,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordUpdate' => 
      array (
        'name' => 'recordUpdate',
        'parameters' => 
        array (
          'update' => 
          array (
            'name' => 'update',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\EntryUpdate',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 347,
            'endLine' => 347,
            'startColumn' => 41,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry update.
 *
 * @param  \\Laravel\\Telescope\\EntryUpdate  $update
 * @return void
 */',
        'startLine' => 347,
        'endLine' => 352,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordBatch' => 
      array (
        'name' => 'recordBatch',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 360,
            'endLine' => 360,
            'startColumn' => 40,
            'endColumn' => 45,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 360,
        'endLine' => 363,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordCache' => 
      array (
        'name' => 'recordCache',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 371,
            'endLine' => 371,
            'startColumn' => 40,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 371,
        'endLine' => 374,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordCommand' => 
      array (
        'name' => 'recordCommand',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 382,
            'endLine' => 382,
            'startColumn' => 42,
            'endColumn' => 61,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 382,
        'endLine' => 385,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordDump' => 
      array (
        'name' => 'recordDump',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 393,
            'endLine' => 393,
            'startColumn' => 39,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 393,
        'endLine' => 396,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordEvent' => 
      array (
        'name' => 'recordEvent',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 404,
            'endLine' => 404,
            'startColumn' => 40,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 404,
        'endLine' => 407,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordException' => 
      array (
        'name' => 'recordException',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 415,
            'endLine' => 415,
            'startColumn' => 44,
            'endColumn' => 63,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 415,
        'endLine' => 418,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordGate' => 
      array (
        'name' => 'recordGate',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 426,
            'endLine' => 426,
            'startColumn' => 39,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 426,
        'endLine' => 429,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordJob' => 
      array (
        'name' => 'recordJob',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 437,
            'endLine' => 437,
            'startColumn' => 38,
            'endColumn' => 43,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 437,
        'endLine' => 440,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordLog' => 
      array (
        'name' => 'recordLog',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 448,
            'endLine' => 448,
            'startColumn' => 38,
            'endColumn' => 57,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 448,
        'endLine' => 451,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordMail' => 
      array (
        'name' => 'recordMail',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 459,
            'endLine' => 459,
            'startColumn' => 39,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 459,
        'endLine' => 462,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordNotification' => 
      array (
        'name' => 'recordNotification',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 470,
            'endLine' => 470,
            'startColumn' => 47,
            'endColumn' => 52,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 470,
        'endLine' => 473,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordQuery' => 
      array (
        'name' => 'recordQuery',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 481,
            'endLine' => 481,
            'startColumn' => 40,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 481,
        'endLine' => 484,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordModelEvent' => 
      array (
        'name' => 'recordModelEvent',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 492,
            'endLine' => 492,
            'startColumn' => 45,
            'endColumn' => 64,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 492,
        'endLine' => 495,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordRedis' => 
      array (
        'name' => 'recordRedis',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 503,
            'endLine' => 503,
            'startColumn' => 40,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 503,
        'endLine' => 506,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordRequest' => 
      array (
        'name' => 'recordRequest',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 514,
            'endLine' => 514,
            'startColumn' => 42,
            'endColumn' => 61,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 514,
        'endLine' => 517,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordScheduledCommand' => 
      array (
        'name' => 'recordScheduledCommand',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 525,
            'endLine' => 525,
            'startColumn' => 51,
            'endColumn' => 70,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 525,
        'endLine' => 528,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordView' => 
      array (
        'name' => 'recordView',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 536,
            'endLine' => 536,
            'startColumn' => 39,
            'endColumn' => 58,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 536,
        'endLine' => 539,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordClientRequest' => 
      array (
        'name' => 'recordClientRequest',
        'parameters' => 
        array (
          'entry' => 
          array (
            'name' => 'entry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\IncomingEntry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 547,
            'endLine' => 547,
            'startColumn' => 48,
            'endColumn' => 67,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given entry.
 *
 * @param  \\Laravel\\Telescope\\IncomingEntry  $entry
 * @return void
 */',
        'startLine' => 547,
        'endLine' => 550,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'flushEntries' => 
      array (
        'name' => 'flushEntries',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Flush all entries in the queue.
 *
 * @return static
 */',
        'startLine' => 557,
        'endLine' => 562,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'catch' => 
      array (
        'name' => 'catch',
        'parameters' => 
        array (
          'e' => 
          array (
            'name' => 'e',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 571,
            'endLine' => 571,
            'startColumn' => 34,
            'endColumn' => 35,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'tags' => 
          array (
            'name' => 'tags',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 571,
                'endLine' => 571,
                'startTokenPos' => 1893,
                'startFilePos' => 13760,
                'endTokenPos' => 1894,
                'endFilePos' => 13761,
              ),
            ),
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 571,
            'endLine' => 571,
            'startColumn' => 38,
            'endColumn' => 47,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Record the given exception.
 *
 * @param  \\Throwable|\\Exception  $e
 * @param  array  $tags
 * @return void
 */',
        'startLine' => 571,
        'endLine' => 577,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'filter' => 
      array (
        'name' => 'filter',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 585,
            'endLine' => 585,
            'startColumn' => 35,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the callback that filters the entries that should be recorded.
 *
 * @param  \\Closure  $callback
 * @return static
 */',
        'startLine' => 585,
        'endLine' => 590,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'filterBatch' => 
      array (
        'name' => 'filterBatch',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 598,
            'endLine' => 598,
            'startColumn' => 40,
            'endColumn' => 56,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the callback that filters the batches that should be recorded.
 *
 * @param  \\Closure  $callback
 * @return static
 */',
        'startLine' => 598,
        'endLine' => 603,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'afterRecording' => 
      array (
        'name' => 'afterRecording',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 611,
            'endLine' => 611,
            'startColumn' => 43,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Set the callback that will be executed after an entry is recorded in the queue.
 *
 * @param  \\Closure  $callback
 * @return static
 */',
        'startLine' => 611,
        'endLine' => 616,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'afterStoring' => 
      array (
        'name' => 'afterStoring',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 624,
            'endLine' => 624,
            'startColumn' => 41,
            'endColumn' => 57,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Add a callback that will be executed after an entry is stored.
 *
 * @param  \\Closure  $callback
 * @return static
 */',
        'startLine' => 624,
        'endLine' => 629,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'tag' => 
      array (
        'name' => 'tag',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 637,
            'endLine' => 637,
            'startColumn' => 32,
            'endColumn' => 48,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Add a callback that adds tags to the record.
 *
 * @param  \\Closure  $callback
 * @return static
 */',
        'startLine' => 637,
        'endLine' => 642,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'store' => 
      array (
        'name' => 'store',
        'parameters' => 
        array (
          'storage' => 
          array (
            'name' => 'storage',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\Contracts\\EntriesRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 650,
            'endLine' => 650,
            'startColumn' => 34,
            'endColumn' => 59,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Store the queued entries and flush the queue.
 *
 * @param  \\Laravel\\Telescope\\Contracts\\EntriesRepository  $storage
 * @return void
 */',
        'startLine' => 650,
        'endLine' => 692,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'collectEntries' => 
      array (
        'name' => 'collectEntries',
        'parameters' => 
        array (
          'batchId' => 
          array (
            'name' => 'batchId',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 700,
            'endLine' => 700,
            'startColumn' => 46,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Collect the entries for storage.
 *
 * @param  string  $batchId
 * @return \\Illuminate\\Support\\Collection
 */',
        'startLine' => 700,
        'endLine' => 710,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'collectUpdates' => 
      array (
        'name' => 'collectUpdates',
        'parameters' => 
        array (
          'batchId' => 
          array (
            'name' => 'batchId',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 718,
            'endLine' => 718,
            'startColumn' => 46,
            'endColumn' => 53,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Collect the updated entries for storage.
 *
 * @param  string  $batchId
 * @return \\Illuminate\\Support\\Collection
 */',
        'startLine' => 718,
        'endLine' => 724,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 18,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'hideRequestHeaders' => 
      array (
        'name' => 'hideRequestHeaders',
        'parameters' => 
        array (
          'headers' => 
          array (
            'name' => 'headers',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 732,
            'endLine' => 732,
            'startColumn' => 47,
            'endColumn' => 60,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Hide the given request header.
 *
 * @param  array  $headers
 * @return static
 */',
        'startLine' => 732,
        'endLine' => 740,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'hideRequestParameters' => 
      array (
        'name' => 'hideRequestParameters',
        'parameters' => 
        array (
          'attributes' => 
          array (
            'name' => 'attributes',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 748,
            'endLine' => 748,
            'startColumn' => 50,
            'endColumn' => 66,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Hide the given request parameters.
 *
 * @param  array  $attributes
 * @return static
 */',
        'startLine' => 748,
        'endLine' => 756,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'hideResponseParameters' => 
      array (
        'name' => 'hideResponseParameters',
        'parameters' => 
        array (
          'attributes' => 
          array (
            'name' => 'attributes',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'array',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 764,
            'endLine' => 764,
            'startColumn' => 51,
            'endColumn' => 67,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Hide the given response parameters.
 *
 * @param  array  $attributes
 * @return static
 */',
        'startLine' => 764,
        'endLine' => 772,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'recordFrameworkEvents' => 
      array (
        'name' => 'recordFrameworkEvents',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Specifies that Telescope should record events fired by Laravel.
 *
 * @return static
 */',
        'startLine' => 779,
        'endLine' => 784,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'night' => 
      array (
        'name' => 'night',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Specifies that Telescope should use the dark theme.
 *
 * @return static
 */',
        'startLine' => 791,
        'endLine' => 796,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'avatar' => 
      array (
        'name' => 'avatar',
        'parameters' => 
        array (
          'callback' => 
          array (
            'name' => 'callback',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Closure',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 804,
            'endLine' => 804,
            'startColumn' => 35,
            'endColumn' => 51,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Register the Telescope user avatar callback.
 *
 * @param  \\Closure  $callback
 * @return static
 */',
        'startLine' => 804,
        'endLine' => 809,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'css' => 
      array (
        'name' => 'css',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the CSS for the Telescope dashboard.
 *
 * @return Illuminate\\Contracts\\Support\\Htmlable
 */',
        'startLine' => 816,
        'endLine' => 835,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'js' => 
      array (
        'name' => 'js',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the JS for the Telescope dashboard.
 *
 * @return \\Illuminate\\Contracts\\Support\\Htmlable
 */',
        'startLine' => 842,
        'endLine' => 858,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
      'scriptVariables' => 
      array (
        'name' => 'scriptVariables',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Get the default JavaScript variables for Telescope.
 *
 * @return array
 */',
        'startLine' => 865,
        'endLine' => 872,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 17,
        'namespace' => 'Laravel\\Telescope',
        'declaringClassName' => 'Laravel\\Telescope\\Telescope',
        'implementingClassName' => 'Laravel\\Telescope\\Telescope',
        'currentClassName' => 'Laravel\\Telescope\\Telescope',
        'aliasName' => NULL,
      ),
    ),
    'traitsData' => 
    array (
      'aliases' => 
      array (
      ),
      'modifiers' => 
      array (
      ),
      'precedences' => 
      array (
      ),
      'hashes' => 
      array (
      ),
    ),
  ),
));