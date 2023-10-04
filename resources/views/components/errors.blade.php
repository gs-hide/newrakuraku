<x-app-layout>

    <!-- ヘッダー[START] -->
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <form action="{{ route('reservation_index') }}" method="GET" class="w-full max-w-lg">
                <x-button class="bg-gray-100 text-gray-900">{{ __('Dashboard') }}</x-button>
            </form>
        </h2>
    </x-slot>
    <!-- ヘッダー[END] -->

    <!-- 全エリア [START] -->
    <div class="flex bg-gray-100">

        <!-- 左側エリア [START] -->
        <div class="w-1/4 text-gray-700 text-left px-4 py-2 m-2 rounded-lg order-1">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 bg-white border-b border-gray-300 font-bold">
                    ご来場事前予約情報
                </div>
            </div>

            <!-- 予約情報入力フォーム -->
            <form action="{{ url('reservations') }}" method="POST" class="w-full max-w-lg">
                @csrf

                <!-- カラム 1: 予約日時 -->
                <div class="flex flex-col mb-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            予約日時
                        </label>
                        <input name="reservation_datetime" type="datetime-local" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" placeholder="">
                    </div>
                </div>

                <!-- カラム 2: 来店時間 -->
                <div class="flex flex-col mb-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            来店時間
                        </label>
                        <input name="visit_time" type="datetime-local" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" placeholder="">
                    </div>
                </div>

                <!-- カラム 3: 顧客ID -->
                <div class="flex flex-col mb-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            顧客ID
                        </label>
                        <input name="customer_id" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                    </div>
                </div>

                <!-- カラム 4: スタッフID -->
                <div class="flex flex-col mb-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            スタッフID
                        </label>
                        <input name="staff_id" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                    </div>
                </div>

                <!-- カラム 5: ステータス -->
                <div class="flex flex-col mb-4">
                    <div class="w-full">
                        <label class="block text-gray-700 text-sm font-bold mb-2">
                            ステータス
                        </label>
                        <input name="status" class="appearance-none block w-full text-gray-700 border rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                    </div>
                </div>

                <!-- 送信ボタン -->
                <div class="text-center">
                    <x-button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        送信
                    </x-button>
                </div>
                
                <!-- JavaScript -->
                <script>
                    function submitFormAndRedirect() {
                        // フォームを送信
                        document.querySelector('form').submit();
                        
                        // 予約確認画面にリダイレクト
                        Route::get('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservation.confirm');

                    }
                </script>
                
            </form>
        </div>
        <!-- 左側エリア [END] -->

       <!-- 右側エリア [START] -->
        <div class="w-3/4 text-gray-700 bg-blue-100 px-4 py-2 m-2 rounded-lg order-2">
            <div class="font-bold mb-4 text-xl">ご予約可能時間</div>
        
            <!-- カレンダー表示 -->
            <div>
                <!-- カレンダーの内容をここに表示 -->
                <!-- 日付・曜日を表示 -->
                @for ($i = 0; $i < 7; $i++)
                <div class="mb-2">
                    {{ now()->addDays($i)->format('Y-m-d (D)') }}
                    </div>
                    <table class="w-full mb-4">
                        <thead>
                            <tr>
                                <th class="text-left"></th>
                                @for ($hour = 10; $hour < 18; $hour++)
                                    <th class="text-center"></th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody>
                            @for ($j = 0; $j < 2; $j++) <!-- 30分ごとのループ -->
                                <tr>
                                    <td class="text-center"></td>
                                    @for ($hour = 10; $hour < 18; $hour++)
                                        <td class="text-center border">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
                                                onclick="selectVisitTime({{ $hour }}, {{ $j * 30 }})">
                                                {{ str_pad($hour, 2, '0', STR_PAD_LEFT) }}:{{ str_pad($j * 30, 2, '0', STR_PAD_LEFT) }}
                                            </button>
                                        </td>
                                    @endfor
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    @endfor
                    <!-- ボタンを追加して前の週・次の週に切り替える -->
                  <!-- ボタンを追加して前の週・次の週に切り替える -->
                    <div class="flex justify-between">
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="changeWeek(-1)">
                            前週
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" onclick="changeWeek(1)">
                            次週
                        </button>
                    </div>
                </div>
            </div>
        </div>
            <!-- JavaScript -->
    <script>
        function selectVisitTime(hour, minute) {
            const visitTimeInput = document.querySelector('input[name="visit_time"]');
            const now = new Date();
            const selectedTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hour, minute);
            const isoFormatTime = selectedTime.toISOString().slice(0, 16);
            visitTimeInput.value = isoFormatTime;
        }

        function changeWeek(offset) {
            const currentDate = new Date();
            currentDate.setDate(currentDate.getDate() + offset * 7); // 1週間分進めたり戻したり
            window.location.href = `/reservations?date=${currentDate.toISOString()}`; // 遷移先URLを設定
        }
    </script>
    
    <!-- JavaScript -->
    <script>
        let currentDate = new Date();  // 現在の日付を保持
     
        function changeWeek(offset) {
            // 現在の日付を週の切り替え分だけ変更
            currentDate.setDate(currentDate.getDate() + offset * 7);
            updateCalendar();
        }
     
        function updateCalendar() {
            // カレンダーの表示を更新する処理をここに追加
            // 日付が変わるたびにカレンダーを更新するコードを書く
            // 例: カレンダーの表示を更新する関数を呼び出す
            console.log('カレンダーを更新しました。日付が変わりました。');
        }
    </script>
        
        <!-- 右側エリア [END] -->

    </div>
    <!-- 全エリア [END] -->



</x-app-layout>

