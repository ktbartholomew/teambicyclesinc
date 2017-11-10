<?php

// Theme Helper is a must-use plugin that ensures this theme (the only one) is
// active.


// This is slightly broken because the previous theme's templates will still
// be used for the first request after this command is applied. After that it's
// business as usual. A warmup request could solve this, but is not easy to
// accomplish in a Docker environment.
switch_theme('theme');
