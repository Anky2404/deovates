<?php declare(strict_types = 1);

// osfsl-F:/xampp/htdocs/testproject/vendor/composer/../intervention/image/src/Interfaces/ImageManagerInterface.php-PHPStan\BetterReflection\Reflection\ReflectionClass-Intervention\Image\Interfaces\ImageManagerInterface
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-702ab397238d25abe223f70c858bbd926b87665630dcb62e9b2414fb844b8a32-8.2.12-6.70.0.3',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'filename' => 'F:/xampp/htdocs/testproject/vendor/composer/../intervention/image/src/Interfaces/ImageManagerInterface.php',
      ),
    ),
    'namespace' => 'Intervention\\Image\\Interfaces',
    'name' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
    'shortName' => 'ImageManagerInterface',
    'isInterface' => true,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 9,
    'endLine' => 63,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => NULL,
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
    ),
    'immediateMethods' => 
    array (
      'create' => 
      array (
        'name' => 'create',
        'parameters' => 
        array (
          'width' => 
          array (
            'name' => 'width',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 18,
            'endLine' => 18,
            'startColumn' => 28,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'height' => 
          array (
            'name' => 'height',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'int',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 18,
            'endLine' => 18,
            'startColumn' => 40,
            'endColumn' => 50,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Intervention\\Image\\Interfaces\\ImageInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create new image instance with given width & height
 *
 * @link https://image.intervention.io/v3/basics/instantiation#create-new-images
 *
 * @throws RuntimeException
 */',
        'startLine' => 18,
        'endLine' => 18,
        'startColumn' => 5,
        'endColumn' => 68,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Intervention\\Image\\Interfaces',
        'declaringClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'implementingClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'currentClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'aliasName' => NULL,
      ),
      'read' => 
      array (
        'name' => 'read',
        'parameters' => 
        array (
          'input' => 
          array (
            'name' => 'input',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'mixed',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 48,
            'endLine' => 48,
            'startColumn' => 26,
            'endColumn' => 37,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'decoders' => 
          array (
            'name' => 'decoders',
            'default' => 
            array (
              'code' => '[]',
              'attributes' => 
              array (
                'startLine' => 48,
                'endLine' => 48,
                'startTokenPos' => 71,
                'startFilePos' => 1745,
                'endTokenPos' => 72,
                'endFilePos' => 1746,
              ),
            ),
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionUnionType',
              'data' => 
              array (
                'types' => 
                array (
                  0 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'string',
                      'isIdentifier' => true,
                    ),
                  ),
                  1 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'array',
                      'isIdentifier' => true,
                    ),
                  ),
                  2 => 
                  array (
                    'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
                    'data' => 
                    array (
                      'name' => 'Intervention\\Image\\Interfaces\\DecoderInterface',
                      'isIdentifier' => false,
                    ),
                  ),
                ),
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 48,
            'endLine' => 48,
            'startColumn' => 40,
            'endColumn' => 83,
            'parameterIndex' => 1,
            'isOptional' => true,
          ),
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Intervention\\Image\\Interfaces\\ImageInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create new image instance from given input which can be one of the following
 *
 * - Path in filesystem
 * - File Pointer resource
 * - SplFileInfo object
 * - Raw binary image data
 * - Base64 encoded image data
 * - Data Uri
 * - Intervention\\Image\\Image Instance
 *
 * To decode the raw input data, you can optionally specify a decoding strategy
 * with the second parameter. This can be an array of class names or objects
 * of decoders to be processed in sequence. In this case, the input must be
 * decodedable with one of the decoders passed. It is also possible to pass
 * a single object or class name of a decoder.
 *
 * All decoders that implement the `DecoderInterface::class` can be passed. Usually
 * a selection of classes of the namespace `Intervention\\Image\\Decoders`
 *
 * If the second parameter is not set, an attempt to decode the input is made
 * with all available decoders of the driver.
 *
 * @link https://image.intervention.io/v3/basics/instantiation#read-image-sources
 *
 * @param string|array<string|DecoderInterface>|DecoderInterface $decoders
 * @throws RuntimeException
 */',
        'startLine' => 48,
        'endLine' => 48,
        'startColumn' => 5,
        'endColumn' => 101,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Intervention\\Image\\Interfaces',
        'declaringClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'implementingClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'currentClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'aliasName' => NULL,
      ),
      'animate' => 
      array (
        'name' => 'animate',
        'parameters' => 
        array (
          'init' => 
          array (
            'name' => 'init',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'callable',
                'isIdentifier' => true,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 57,
            'endLine' => 57,
            'startColumn' => 29,
            'endColumn' => 42,
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
            'name' => 'Intervention\\Image\\Interfaces\\ImageInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Create new animated image by given callback
 *
 * @link https://image.intervention.io/v3/basics/instantiation#create-animations
 *
 * @throws RuntimeException
 */',
        'startLine' => 57,
        'endLine' => 57,
        'startColumn' => 5,
        'endColumn' => 60,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Intervention\\Image\\Interfaces',
        'declaringClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'implementingClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'currentClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'aliasName' => NULL,
      ),
      'driver' => 
      array (
        'name' => 'driver',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'Intervention\\Image\\Interfaces\\DriverInterface',
            'isIdentifier' => false,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * Return currently used driver
 */',
        'startLine' => 62,
        'endLine' => 62,
        'startColumn' => 5,
        'endColumn' => 46,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'Intervention\\Image\\Interfaces',
        'declaringClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'implementingClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
        'currentClassName' => 'Intervention\\Image\\Interfaces\\ImageManagerInterface',
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