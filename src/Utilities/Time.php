<?php
declare(strict_types=1);


namespace Toolkit\Utilities;


use Cake\Error\FatalErrorException;
use Cake\Utility\Text;

class Time
{

    /**
     * @param int $time
     * @param array $options
     * @return string
     */
    public static function formatFromSeconds(int $time, array $options = []): string
    {
        $min = 0;
        $max = 60 * 60 * 24 * 30;

        $options += [
            'before' => '',
            'after' => '',
        ];
        $before = !empty($options['before']) ? $options['before'] . ' ' : '';
        $after = !empty($options['after']) ? ' ' . $options['after'] : '';
        if ($time < $min) {
            throw new FatalErrorException('Seconds must to be greater than 0');
        }
        if ($time > $max) {
            throw new FatalErrorException(sprintf('Seconds must to be less than %s (30 days)', $max));
        }
        $days = (int)gmdate('d', $time) - 1;
        $hours = (int)gmdate('H', $time);
        $minutes = (int)gmdate('i', $time);
        $seconds = (int)gmdate('s', $time);
        $formatList = [];
        if ($days > 0) {
            $formatList[] = __n('{0} dia', '{0} dias', $days, $days);
        }
        if ($hours > 0) {
            $formatList[] = __n('{0} hora', '{0} horas', $hours, $hours);
        }
        if ($minutes > 0) {
            $formatList[] = __n('{0} minuto', '{0} minutos', $minutes, $minutes);
        }
        if ($seconds > 0) {
            $formatList[] = __n('{0} segundo', '{0} segundos', $seconds, $seconds);
        }

        return $before . Text::toList($formatList, __('e')) . $after;
    }

}