<?php

namespace VoDebug;

class VoDebugTwigExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('vo_debug', '\VoDebug\twig_vo_debug', array('is_safe' => array('html'), 'needs_context' => true, 'needs_environment' => true)),
        );
    }

    public function getName()
    {
        return 'vo_debug';
    }
}

function twig_vo_debug(\Twig_Environment $env, $context)
{
    if (!$env->isDebug()) {
        return;
    }

    ob_start();

    $count = func_num_args();
    
    $voDebug = new VoDebug();
    $voDebug->setDumpers(
        new Dumpers\StringDumper(),
        new Dumpers\NumberDumper(),
        new Dumpers\ArrayDumper($voDebug),
        new Dumpers\ObjectDumper($voDebug)
    );
    
    if (2 === $count) {
        $vars = array();
        foreach ($context as $key => $value) {
            if (!$value instanceof \Twig_Template) {
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