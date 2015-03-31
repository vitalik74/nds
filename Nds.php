<?php
namespace vitalik74;

use Exception;

/**
 * Class Nds
 * @author Tsibikov Vitaliy <tsibikov_vit@mail.ru> <tsibikov.com>
 * @method allocationNds($sum, $nds = 0) Выделение НДС из суммы. Возвращает НДС.
 * @method allocationSumWithoutNds($sum, $nds = 0) Выделение НДС из суммы. Возвращает сумму без НДС.
 * @method chargeNds($sum, $nds = 0) Начисление НДС от суммы. Возвращает НДС суммы.
 * @method chargeSumWithNds($sum, $nds = 0) Начисление НДС от суммы. Возвращает сумму с НДС.
 *
 * Use:
 * Read README.md
 */
class Nds
{
    /**
     * Default Nds
     */
    const NDS = 18;

    /**
     * Run methods
     * @param $type
     * @param $sum
     * @param $nds
     * @return mixed
     * @throws \Exception
     */
    private function init($type, $sum, $nds)
    {
        if (empty($sum)) {
            throw new \Exception('No set "sum"');
        }

        if (empty($nds)) {
            $nds = self::NDS;
        }

        return $this->{$type}($sum, $nds);
    }

    /**
     * Separate Nds and Sum without Nds
     * @param $sum
     * @param $nds
     * @return array
     */
    private function allocation($sum, $nds)
    {
        $nds = round((($sum / (1 + ($nds / 100)) - $sum) * -1), 2);

        return array(
            'sum' => $sum - $nds,
            'nds' => $nds
        );
    }

    /**
     * Charge
     * @param $sum
     * @param $nds
     * @return array
     */
    private function charge($sum, $nds)
    {
        $nds = $sum * ($nds / 100);

        return array(
            'sum' => $sum + $nds,
            'nds' => $nds
        );
    }

    /**
     * Magic method to call functions
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws Exception
     */
    public function __call($name, $arguments) {
        $allowMethod = array('allocationNds', 'allocationSumWithoutNds', 'chargeNds', 'chargeSumWithNds');

        if (in_array($name, $allowMethod)) {
            $nameMethod = str_replace(array('SumWithoutNds', 'SumWithNds', 'Nds'), '', $name);
            $val = $this->init($nameMethod, $arguments[0], $arguments[1]);

            return strpos($name, 'Sum') !== false ? $val['sum'] : $val['nds'];
        } else {
            throw new Exception('No method in class');
        }
    }
}