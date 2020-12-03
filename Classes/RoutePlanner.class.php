<?php

class RoutePlanner
{
    private $slope = [];
    private $slope_width = 0;
    private $slope_height = 0;
    private $current_x = 0;
    private $current_y = 0;

    public function __construct($slope_data)
    {
        $slope_line = explode("\n", $slope_data);

        foreach ($slope_line as $y => $slope) {
            foreach (str_split($slope) as $x => $object) {
                $this->slope[$x][$y] = $object;
            }
        }

        $this->slope_width = $x;
        $this->slope_height = $y;
    }

    public function reset()
    {
        $this->current_x = 0;
        $this->current_y = 0;
    }

    public function move($x, $y)
    {
        $this->current_x = ($this->current_x + $x) % ($this->slope_width + 1);
        $this->current_y += $y;

        if ($this->current_y > $this->slope_height) {
            throw new Exception('Readed bottom of slope');
        }
    }

    public function isCurrentPositionTree()
    {
        if ($this->slope[$this->current_x][$this->current_y] == '#') {
            return true;
        } else {
            return false;
        }
    }

    public function testVector($vector_x, $vector_y)
    {
        $this->reset();

        //Utility::log($this->slope);

        $tree_count = 0;
        try {
            while ($this->current_y < $this->slope_height) {
                $this->move($vector_x, $vector_y);

                //Utility::log('x now: ' . $this->current_x);
                //Utility::log('y now: ' . $this->current_y);

                $is_tree = $this->isCurrentPositionTree();

                //Utility::log('is_tree: ' . $is_tree);

                $tree_count += $is_tree;
            }
        } catch (Exception $e) {
            Utility::log($e->getMessage());
        }

        return $tree_count;
    }
}
