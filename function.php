<?php

/**
 * Get all files from the inc folder and include them
 */

foreach( glob('inc/*.php') as $inc )
{
    include($inc);
}
