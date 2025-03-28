<?php
namespace App\Traits;

use App\Charts\DashboardChart;

trait DashboardTrait
{
    public function generateLineChart($labels, array $dataset, $title)
    {
        $chart = new DashboardChart;

        $chart->labels($labels);
        $chart->dataset($title, 'line', $dataset)
            ->color('rgb(61, 105, 166)')
            ->backgroundColor('rgba(43, 117, 192, 0.2)')
            ->fill(true);

        $chart->options([
            'responsive'          => true,
            'maintainAspectRatio' => false,
            'scales'              => [
                'yAxes' => [
                    [
                        'ticks' => [
                            'beginAtZero' => true,
                            'fontColor'   => 'black',
                        ],
                    ],
                ],
                'xAxes' => [
                    [
                        'ticks' => [
                            'fontColor' => 'black',
                        ],
                    ],
                ],
            ],
        ]);

        return $chart;
    }

    public function generatePieChart($label, array $dataset, $title): DashboardChart
    {
        $chart = new DashboardChart;
        $chart->labels($label);
        $chart->dataset($title, 'pie', $dataset)
            ->backgroundColor(['#3D69A6', '#2B75C0']); // Adjust colors

        $chart->displayLegend(true);
        $chart->title($title);
        $chart->options([
            'title'               => [
                'display'   => true,
                'text'      => $title,
                'fontSize'  => 16,
                'fontColor' => 'black',
            ],
            'responsive'          => true,
            'maintainAspectRatio' => false,
        ]);

        return $chart;
    }

    public function generateBarChart($label, array $dataset, $title, $horizontal = false)
    {
        $chart = new DashboardChart;
        $chart->labels($label);
        $chartType = $horizontal ? 'horizontalBar' : 'bar'; // Support horizontal bars

        $chart->dataset($title, $chartType, $dataset)
            ->color('rgb(40, 70, 130)')
            ->backgroundColor('rgb(40, 70, 130)');

        $chart->displayLegend(false);
        $chart->title($title);
        $chart->options([
            'responsive'          => true,
            'maintainAspectRatio' => false,
            'scales'              => [
                'xAxes' => [[
                    'barThickness' => 20,
                    'ticks'        => [
                        'beginAtZero' => true,
                        'stepSize'    => 10,
                        'fontColor'   => 'black',
                        'autoSkip'    => false,
                        'maxRotation' => 45,
                        'minRotation' => 45,
                    ],
                ]],
            ],
        ]);

        return $chart;
    }
}
