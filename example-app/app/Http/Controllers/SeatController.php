<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    //
    public function createSeats(Request $request)
    {
        //Берем массив мест из запроса
        $arraySeats = json_decode($request->input('arraySeats'), true);
        // $arraySeats = $request->input('arraySeats');
        //  dd($request->input());
        // dd($arraySeats);

        // // Проходимся по полученному массиву мест
        // foreach ($arraySeats as $seatFromArray) {
        //     $seat = Seat::find($seatFromArray['id']);

        // if (!$seat) { // Если запись с таким id не найдена
        //     $seat = new Seat(); // Создаем новый экземпляр
        // }

        //проходимся по полученному массиву мест 
        foreach ($arraySeats as $seatFromArray) {
            $seat = Seat::find($seatFromArray['id']);
            if (!$seat) { // Если запись с таким id не найдена
                $seat = new Seat(); // Создаем новый экземпляр
            }
            //$seat = new Seat();
            //Заполняем переданные из формы данные в свойства экземпляра места
            $seat->id = $seatFromArray['id'];
            $seat->row_number = $seatFromArray['row_number'];
            $seat->seats_number = $seatFromArray['seats_number'];
            $seat->type = $seatFromArray['type'];
            $seat->hall_id = $request->input('idHall');
            $seat->save();
        }

        // dd($rows, $seats_per_row);
        return redirect()->back()->with('success', 'Места создаы:');
    }


    // public function createSeats(Request $request)
    // {
    //     $rows = $request->input('rows'); //Получаем количество рядов из запроса
    //     $seats_per_row = $request->input('seats_per_row');  //Получаем количество мест в ряды из запроса
    //     $idHall = $request->input('idHall'); //Получаем id зала из запроса
    //     //dd($request->input());

    //     for ($i = 1; $i <= $rows; $i++) { //проходимся по каждому ряду

    //         for ($j = 1; $j <= $seats_per_row; $j++) { //проходимся по каждому месту в ряду
    //             $seat = new Seat();
    //             //Заполняем переданные из формы данные в свойства экземпляра места
    //             $seat->row_number = $i;
    //             $seat->seats_number = $j;
    //             $seat->hall_id = $idHall;

    //            // $seat->save(); // сохраняем экземпляр данного места в таблицу seat
    //         }
    //     }

    //     //Обновляем значения стобцов ряды и количество мест в ряду у выбранного зала в таблице залов
    //     $hall = Hall::find($idHall);
    //     $hall->rows_count = $rows;
    //     $hall->seats_per_row = $seats_per_row;
    //     $hall->save();

    //     // dd($rows, $seats_per_row);
    //     return redirect()->back()->with('success', 'Места создаы:');
    // }

    public function getSeatsByHallId($idHall)
    {
        //Получаем все места для указанного зала
        $seats = Seat::where('hall_id', $idHall)->get();

        return response()->json($seats);

    }
}
