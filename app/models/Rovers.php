<?php
namespace App\Models;

/**
 *
 * @OA\Schema(
 *     title="Rovers",
 *     @OA\Xml(
 *         name="Rovers"
 *     )
 * )
 */

class Rovers extends \Phalcon\Mvc\Model
{

    /**
     * * @OA\Property(
     *     title="Id",
     *     description="Id",
     *     format="int64",
     * )
     *
     * @var integer
     */
    public $id;

    /**
     *  @OA\Property(
     *     title="Rover name",
     *     description="Rover name"
     * )
     *
     * @var string
     */
    public $name;

    /**
     *  @OA\Property(
     *     title="Rover plateau id",
     *     description="Rover plateau id"
     * )
     *
     * @var integer
     */
    public $plateauId;

    /**
     *  @OA\Property(
     *     title="Rover x coordinate",
     *     description="Rover x coordinate"
     * )
     *
     * @var integer
     */
    public $xCoor;

    /**
     *  @OA\Property(
     *     title="Rover y coordinate",
     *     description="Rover y coordinate"
     * )
     *
     * @var integer
     */
    public $yCoor;

    /**
     *  @OA\Property(
     *     title="Rover facing",
     *     description="Rover facing"
     * )
     *
     * @var integer
     */
    public $facing;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("marsrover_db");
        $this->setSource("rovers");
        $this->hasMany('Id', 'Sendedcommands', 'RoverId', ['alias' => 'Sendedcommands']);
        $this->belongsTo('PlateauId', 'Plateaus', 'Id', ['alias' => 'Plateaus']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'rovers';
    }
    
    public function validation()
    {
        $validator = new Validation();        
        $validator->add(
            [
                "Name",
                "PlateauId",
                "XCoor",
                "YCoor",
                "Facing",
            ],
            new PresenceOf(
                [
                    "message" => [
                        "Name" => "Robot ismi bo?? ge??ilemez.",
                        "PlateauId" => "Plato bo?? ge??ilemez.",
                        "XCoor" => "X koordinat?? bo?? ge??ilemez.",
                        "YCoor"  => "Y koordinat?? bo?? ge??ilemez.",
                        "Facing"  => "Robot y??n?? bo?? ge??ilemez.",
                    ],
                ]
            )
        );

        $validator->add(
            [
                "XCoor",
                "YCoor",
            ],
            new Digit(
                [
                    "message" => [
                        "XCoor" => "X koordinat?? say??sal de??er olmal??d??r",
                        "YCoor"  => "Y koordinat?? say??sal de??er olmal??d??r",
                    ],
                ]
            )
        );

        $validator->add(
            "type",
            new InclusionIn(
                [
                    'message' => 'Robot y??n?? "N", "S", "W" ya da "E" olmal??d??r.',
                    'domain' => [
                        'N',
                        'S',
                        'W',
                        'E'
                    ],
                ]
            )
        );


        if ($this->validationHasFailed() === true) {
            return false;
        }
    }


    public function setName($name)
    {
        $this->Name = $name;

        return $this;
    }

    public function setPlateauId($plateau_id)
    {
        $this->PlateauId = $plateau_id;

        return $this;
    }

    public function setFacing($facing)
    {
        $this->Facing = $facing;

        return $this;
    }

    public function setXCoor($xcoor)
    {
        $this->XCoor = $xcoor;

        return $this;
    }

    public function setYCoor($ycoor)
    {
        $this->YCoor = $ycoor;

        return $this;
    }
}
