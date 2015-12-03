<?php

/*
 * This file is an extension to Twig (http://twig.sensiolabs.org/)
 *
 * (c) 2015 Przemyslaw Koltermann
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class Twig_Extension_WhatsInTheBag extends Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('witb', 'twig_witb', array('is_safe' => array('html'), 'needs_context' => true, 'needs_environment' => true)),
        );
    }

    public function getName()
    {
        return 'whats_in_the_bag';
    }
}

function twig_witb(Twig_Environment $env, $context)
{
    if (!$env->isDebug()) {
        return;
    }

    ob_start();

    $count = func_num_args();
    
    $voDebug = new \VoDebug\VoDebug();
    $voDebug->setDumpers(
        new VoDebug\Dumpers\StringDumper(), 
        new VoDebug\Dumpers\NumberDumper(),
        new \VoDebug\Dumpers\ArrayDumper($voDebug), 
        new VoDebug\Dumpers\ObjectDumper($voDebug)
    );
    
    if (2 === $count) {
        $vars = array();
        foreach ($context as $key => $value) {
            if (!$value instanceof Twig_Template) {
                $vars[$key] = $value;
            }
        }

        echo $voDebug->dump($vars);
    } else {
        for ($i = 2; $i < $count; ++$i) {
            echo $voDebug->dump(func_get_arg($i));
        }
    }

    return ob_get_clean();
}