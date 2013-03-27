<?php namespace Mews\Thumb;

require_once __DIR__ . '/lib/ThumbLib.inc.php';

use View, Config, File;
use Illuminate\Config\Repository;

use PhpThumbFactory;


/**
 *
 * Laravel 4 Phpthumb package
 * @copyright Copyright (c) 2013 MeWebStudio
 * @version 1.0.0
 * @author Muharrem ERİN
 * @contact me@mewebstudio.com
 * @link http://www.mewebstudio.com
 * @date 2013-03-21
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 */

class Thumb {

    /**
     * @var  Phpthumb singleton instance of the HTML Purifier object
     */
    protected static $singleton;

    /**
     * @var  image file location
     */
    protected static $file;

    /**
     * @var  image file name
     */
    protected static $filename;

    /**
     * @var  image base path
     */
    protected static $dirPath;

    /**
     * @var  image object
     */
    protected static $image;

    /**
     * Returns the singleton instance of Phpthumb. If no instance has
     * been created, a new instance will be created.
     *
     *     $thumb = Thumb::instance();
     *
     * @return  Phpthumb
     */
    public static function instance()
    {
        if ( ! Thumb::$singleton)
        {
            Thumb::$singleton = new Thumb();
        }

        return Thumb::$singleton;
    }

    /**
     * Create Image.
     *
     * @param  $file
     * @param  $width
     * @param  $height
     * @param  $type
     * @return object
     */
    public static function create($image)
    {

        self::$file = $image;
        self::$filename = basename(self::$file);
        self::$dirPath = rtrim(self::$file, self::$filename);

        self::$image = PhpThumbFactory::create(self::$file);
        return Thumb::$singleton;

    }

    /**
     * Make Image.
     *
     * @param  $args [width,height,type,...]
     * @return object
     */
    public function make($perform, $args)
    {

        $make_type = isset($args[2]) ? $args[2] : 'regular';

        if ($perform == 'resize')
        {
            if ($make_type == 'adaptive')
            {
                self::$image->adaptiveResize($args[0], $args[1]);
            }
            elseif ($make_type == 'percent')
            {
                self::$image->resizePercent($args[0]);    
            }
            else
            {
                self::$image->resize($args[0], $args[1]);
            }
        }
        elseif ($perform == 'crop')
        {
            if ($args[0] == 'center')
            {
                self::$image->cropFromCenter($args[1], $args[2]);
            }
            else
            {
                self::$image->crop($args[1], $args[2], $args[3], $args[4]);
            }
        }
        else
        {
            // show original image :)
        }

        return $this;

    }

    /**
     * Rotate Image.
     *
     * @param  $val -> mixed
     * @param  $direction
     * @return object
     */
    public function rotate($args)
    {

        if ($args[0] = 'direction')
        {
            self::$image->rotateImage($args[1]);
        }
        elseif ($args[0] = 'degree')
        {
            self::$image->rotateImageNDegrees($args[1]);
        }

        return $this;

    }

    /**
     * Reflection Image.
     *
     * @params  $percent, $reflection, $white, $border, $borderColor
     * @return object
     */
    public function reflection($args)
    {

        self::$image->createReflection($args[0], $args[1], $args[2], $args[3], $args[4]);

        return $this;

    }

    /**
     * Show Image.
     *
     * @return object
     */
    public function show()
    {

        self::$image->show();

        return $this;

    }

    /**
     * Save Image.
     *
     * @param  $savePath
     * @param  $filename
     * @param  $format
     * @return object
     */
    public function save($savePath = null, $filename = null, $format = null)
    {

        self::$image->save(($savePath ? $savePath : self::$dirPath) . ($filename ? $filename : self::$filename), ($format ? $format : File::extension(self::$filename)));

        return $this;

    }

}