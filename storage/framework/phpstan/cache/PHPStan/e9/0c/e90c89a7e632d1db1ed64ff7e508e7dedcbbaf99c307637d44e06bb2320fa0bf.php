<?php declare(strict_types = 1);

// osfsl-F:/xampp/htdocs/testproject/vendor/composer/../laravel/telescope/src/Console/PruneCommand.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Laravel\Telescope\Console\PruneCommand
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-e7d2e2f09424bdc6c3f985ced7d06bb63f9da7e9f7d4af011176713e08ac504b-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Laravel\\Telescope\\Console\\PruneCommand',
        'filename' => 'F:/xampp/htdocs/testproject/vendor/composer/../laravel/telescope/src/Console/PruneCommand.php',
      ),
    ),
    'namespace' => 'Laravel\\Telescope\\Console',
    'name' => 'Laravel\\Telescope\\Console\\PruneCommand',
    'shortName' => 'PruneCommand',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
      0 => 
      array (
        'name' => 'Symfony\\Component\\Console\\Attribute\\AsCommand',
        'isRepeated' => false,
        'arguments' => 
        array (
          'name' => 
          array (
            'code' => '\'telescope:prune\'',
            'attributes' => 
            array (
              'startLine' => 9,
              'endLine' => 9,
              'startTokenPos' => 28,
              'startFilePos' => 199,
              'endTokenPos' => 28,
              'endFilePos' => 215,
            ),
          ),
        ),
      ),
    ),
    'startLine' => 9,
    'endLine' => 36,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'Illuminate\\Console\\Command',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'signature' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Console\\PruneCommand',
        'implementingClassName' => 'Laravel\\Telescope\\Console\\PruneCommand',
        'name' => 'signature',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'telescope:prune {--hours=24 : The number of hours to retain Telescope data} {--keep-exceptions : Retain exception data}\'',
          'attributes' => 
          array (
            'startLine' => 17,
            'endLine' => 17,
            'startTokenPos' => 50,
            'startFilePos' => 379,
            'endTokenPos' => 50,
            'endFilePos' => 499,
          ),
        ),
        'docComment' => '/**
 * The name and signature of the console command.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 17,
        'endLine' => 17,
        'startColumn' => 5,
        'endColumn' => 149,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'description' => 
      array (
        'declaringClassName' => 'Laravel\\Telescope\\Console\\PruneCommand',
        'implementingClassName' => 'Laravel\\Telescope\\Console\\PruneCommand',
        'name' => 'description',
        'modifiers' => 2,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'Prune stale entries from the Telescope database\'',
          'attributes' => 
          array (
            'startLine' => 24,
            'endLine' => 24,
            'startTokenPos' => 61,
            'startFilePos' => 614,
            'endTokenPos' => 61,
            'endFilePos' => 662,
          ),
        ),
        'docComment' => '/**
 * The console command description.
 *
 * @var string
 */',
        'attributes' => 
        array (
        ),
        'startLine' => 24,
        'endLine' => 24,
        'startColumn' => 5,
        'endColumn' => 79,
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
      'handle' => 
      array (
        'name' => 'handle',
        'parameters' => 
        array (
          'repository' => 
          array (
            'name' => 'repository',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Laravel\\Telescope\\Contracts\\PrunableRepository',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 32,
            'endLine' => 32,
            'startColumn' => 28,
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
 * Execute the console command.
 *
 * @param  \\Laravel\\Telescope\\Contracts\\PrunableRepository  $repository
 * @return void
 */',
        'startLine' => 32,
        'endLine' => 35,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Laravel\\Telescope\\Console',
        'declaringClassName' => 'Laravel\\Telescope\\Console\\PruneCommand',
        'implementingClassName' => 'Laravel\\Telescope\\Console\\PruneCommand',
        'currentClassName' => 'Laravel\\Telescope\\Console\\PruneCommand',
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