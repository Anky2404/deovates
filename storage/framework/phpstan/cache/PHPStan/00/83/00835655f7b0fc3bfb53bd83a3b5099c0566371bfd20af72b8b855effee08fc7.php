<?php declare(strict_types = 1);

// odsl-F:\xampp\htdocs\testproject\app\Http\Controllers\Front\ContactController.php-PHPStan\BetterReflection\Reflection\ReflectionClass-App\Http\Controllers\Front\ContactController
return \PHPStan\Cache\CacheItem::__set_state(array(
   'variableKey' => 'v2-6.70.0.3-8.2.12-ccdbbcb165f99249e6707e8b09e83b13bdd54798451a953e5a008a9778ceca7e',
   'data' => 
  array (
    'locatedSource' => 
    array (
      'class' => 'PHPStan\\BetterReflection\\SourceLocator\\Located\\LocatedSource',
      'data' => 
      array (
        'name' => 'App\\Http\\Controllers\\Front\\ContactController',
        'filename' => 'F:/xampp/htdocs/testproject/app/Http/Controllers/Front/ContactController.php',
      ),
    ),
    'namespace' => 'App\\Http\\Controllers\\Front',
    'name' => 'App\\Http\\Controllers\\Front\\ContactController',
    'shortName' => 'ContactController',
    'isInterface' => false,
    'isTrait' => false,
    'isEnum' => false,
    'isBackedEnum' => false,
    'modifiers' => 0,
    'docComment' => NULL,
    'attributes' => 
    array (
    ),
    'startLine' => 19,
    'endLine' => 205,
    'startColumn' => 1,
    'endColumn' => 1,
    'parentClassName' => 'App\\Http\\Controllers\\Controller',
    'implementsClassNames' => 
    array (
    ),
    'traitClassNames' => 
    array (
      0 => 'App\\Http\\Controllers\\Front\\Concerns\\LoadsPageSections',
    ),
    'immediateConstants' => 
    array (
    ),
    'immediateProperties' => 
    array (
      'prefix' => 
      array (
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'name' => 'prefix',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'front.\'',
          'attributes' => 
          array (
            'startLine' => 23,
            'endLine' => 23,
            'startTokenPos' => 93,
            'startFilePos' => 568,
            'endTokenPos' => 93,
            'endFilePos' => 575,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 23,
        'endLine' => 23,
        'startColumn' => 5,
        'endColumn' => 31,
        'isPromoted' => false,
        'declaredAtCompileTime' => true,
        'immediateVirtual' => false,
        'immediateHooks' => 
        array (
        ),
      ),
      'folder' => 
      array (
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'name' => 'folder',
        'modifiers' => 4,
        'type' => NULL,
        'default' => 
        array (
          'code' => '\'contact.\'',
          'attributes' => 
          array (
            'startLine' => 25,
            'endLine' => 25,
            'startTokenPos' => 102,
            'startFilePos' => 601,
            'endTokenPos' => 102,
            'endFilePos' => 610,
          ),
        ),
        'docComment' => NULL,
        'attributes' => 
        array (
        ),
        'startLine' => 25,
        'endLine' => 25,
        'startColumn' => 5,
        'endColumn' => 33,
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
      'index' => 
      array (
        'name' => 'index',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 27,
        'endLine' => 34,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'aliasName' => NULL,
      ),
      'store' => 
      array (
        'name' => 'store',
        'parameters' => 
        array (
          'request' => 
          array (
            'name' => 'request',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'Illuminate\\Http\\Request',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 36,
            'endLine' => 36,
            'startColumn' => 27,
            'endColumn' => 42,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
        ),
        'returnsReference' => false,
        'returnType' => NULL,
        'attributes' => 
        array (
        ),
        'docComment' => NULL,
        'startLine' => 36,
        'endLine' => 101,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 1,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'aliasName' => NULL,
      ),
      'sendEnquiryEmails' => 
      array (
        'name' => 'sendEnquiryEmails',
        'parameters' => 
        array (
          'enquiry' => 
          array (
            'name' => 'enquiry',
            'default' => NULL,
            'type' => 
            array (
              'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
              'data' => 
              array (
                'name' => 'App\\Models\\Enquiry',
                'isIdentifier' => false,
              ),
            ),
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 115,
            'endLine' => 115,
            'startColumn' => 40,
            'endColumn' => 55,
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
 * Confirmation to the enquirer + notification to every admin address
 * in config(\'constants.EMAIL.send\') — static, hardcoded mail designs
 * (App\\Mail\\ContactUserConfirmationMail / ContactAdminNotificationMail),
 * no database template lookup. Every send is still recorded in both
 * the Emails table and the Email Logs table.
 *
 * @return bool whether the enquirer\'s own confirmation email sent
 *              successfully — an admin-copy failure alone doesn\'t
 *              fail this, since the visitor\'s submission still went
 *              through fine on their end.
 */',
        'startLine' => 115,
        'endLine' => 124,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'aliasName' => NULL,
      ),
      'sendAndLog' => 
      array (
        'name' => 'sendAndLog',
        'parameters' => 
        array (
          'toEmail' => 
          array (
            'name' => 'toEmail',
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
            'startLine' => 126,
            'endLine' => 126,
            'startColumn' => 33,
            'endColumn' => 47,
            'parameterIndex' => 0,
            'isOptional' => false,
          ),
          'toName' => 
          array (
            'name' => 'toName',
            'default' => NULL,
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
                      'name' => 'null',
                      'isIdentifier' => true,
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
            'startLine' => 126,
            'endLine' => 126,
            'startColumn' => 50,
            'endColumn' => 64,
            'parameterIndex' => 1,
            'isOptional' => false,
          ),
          'mailable' => 
          array (
            'name' => 'mailable',
            'default' => NULL,
            'type' => NULL,
            'isVariadic' => false,
            'byRef' => false,
            'isPromoted' => false,
            'attributes' => 
            array (
            ),
            'startLine' => 126,
            'endLine' => 126,
            'startColumn' => 67,
            'endColumn' => 75,
            'parameterIndex' => 2,
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
        'docComment' => NULL,
        'startLine' => 126,
        'endLine' => 194,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'aliasName' => NULL,
      ),
      'adminNotificationEmails' => 
      array (
        'name' => 'adminNotificationEmails',
        'parameters' => 
        array (
        ),
        'returnsReference' => false,
        'returnType' => 
        array (
          'class' => 'PHPStan\\BetterReflection\\Reflection\\ReflectionNamedType',
          'data' => 
          array (
            'name' => 'array',
            'isIdentifier' => true,
          ),
        ),
        'attributes' => 
        array (
        ),
        'docComment' => '/**
 * @return array<int, string>
 */',
        'startLine' => 199,
        'endLine' => 204,
        'startColumn' => 5,
        'endColumn' => 5,
        'couldThrow' => false,
        'isClosure' => false,
        'isGenerator' => false,
        'isVariadic' => false,
        'modifiers' => 4,
        'namespace' => 'App\\Http\\Controllers\\Front',
        'declaringClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'implementingClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
        'currentClassName' => 'App\\Http\\Controllers\\Front\\ContactController',
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