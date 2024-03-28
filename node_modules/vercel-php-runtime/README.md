<h1 align=center>PHP Runtime for <a href="https://vercel.com">Vercel</h1>

This is a fork of https://github.com/juicyfx/vercel-php

The current version 0.1.0 gives you PHP7.4 and Node 14.

This will help you solve vercel errors like `The Runtime "vercel-php@0.3.1" is using "nodejs12.x", which is discontinued.`

Now, you can update your PHP runtime to use `vercel-php-runtime@0.1.0`

```
"functions": {
        "api/*.php": { "runtime": "vercel-php-runtime@0.1.0" }
},
```
