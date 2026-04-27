<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Perhitungan TOPSIS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }

        h1 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 5px;
            text-transform: uppercase;
        }

        h2 {
            font-size: 12px;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 3px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 5px 8px;
            text-align: center;
        }

        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .bg-gray {
            background-color: #f9f9f9;
        }

        .highlight {
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .text-red-highlight {
            color: #c70039;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>Laporan Sistem Pendukung Keputusan (BPNT)</h1>
    <div class="subtitle">Metode TOPSIS (Technique for Order Preference by Similarity to Ideal Solution)</div>

    <!-- 1. Kriteria & Bobot -->
    <h2>1. Data Kriteria dan Bobot</h2>
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th class="text-left">Nama Kriteria</th>
                <th>Atribut</th>
                <th>Bobot</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kriterias as $k)
                <tr>
                    <td>{{ $k->kode }}</td>
                    <td class="text-left">{{ $k->nama }}</td>
                    <td>{{ $k->atribut }}</td>
                    <td>{{ $k->bobot }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 2. Matriks Keputusan & Pembagi -->
    <h2>2. Matriks Keputusan (X) & Pembagi</h2>
    <table>
        <thead>
            <tr>
                <th class="text-left">Alternatif</th>
                @foreach ($kriterias as $k)
                    <th>{{ $k->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <!-- Pembagi -->
            <tr class="bg-gray highlight">
                <td class="text-left"><i>Pembagi (Divisor)</i></td>
                @foreach ($kriterias as $k)
                    <td>{{ number_format($divisors[$k->id], 4) }}</td>
                @endforeach
            </tr>
            @foreach ($alternatifs as $alt)
                <tr>
                    <td class="text-left">{{ $alt->objek->nama ?? 'Alt ' . $alt->id }}</td>
                    @foreach ($kriterias as $k)
                        <td>{{ $matrix[$alt->id][$k->id] ?? 0 }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="page-break"></div>

    <!-- 3. Matriks Ternormalisasi -->
    <h2>3. Matriks Ternormalisasi (R)</h2>
    <table>
        <thead>
            <tr>
                <th class="text-left">Alternatif</th>
                @foreach ($kriterias as $k)
                    <th>{{ $k->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifs as $alt)
                <tr>
                    <td class="text-left">{{ $alt->objek->nama ?? 'Alt ' . $alt->id }}</td>
                    @foreach ($kriterias as $k)
                        <td>{{ number_format($normalizedMatrix[$alt->id][$k->id] ?? 0, 4) }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 4. Matriks Ternormalisasi Berbobot -->
    <h2>4. Matriks Ternormalisasi Berbobot (Y)</h2>
    <table>
        <thead>
            <tr>
                <th class="text-left">Alternatif</th>
                @foreach ($kriterias as $k)
                    <th>{{ $k->kode }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($alternatifs as $alt)
                <tr>
                    <td class="text-left">{{ $alt->objek->nama ?? 'Alt ' . $alt->id }}</td>
                    @foreach ($kriterias as $k)
                        <td>{{ number_format($weightedMatrix[$alt->id][$k->id] ?? 0, 4) }}</td>
                    @endforeach
                </tr>
            @endforeach
            <!-- Ideal Positif & Negatif -->
            <tr class="bg-gray highlight">
                <td class="text-left">Ideal Positif (A+)</td>
                @foreach ($kriterias as $k)
                    <td>{{ number_format($idealPositive[$k->id] ?? 0, 4) }}</td>
                @endforeach
            </tr>
            <tr class="bg-gray highlight">
                <td class="text-left">Ideal Negatif (A-)</td>
                @foreach ($kriterias as $k)
                    <td>{{ number_format($idealNegative[$k->id] ?? 0, 4) }}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <!-- 5. Jarak & Preferensi -->
    <h2>5. Jarak Solusi Ideal & Nilai Preferensi (Hasil Akhir)</h2>
    <table>
        <thead>
            <tr>
                <th>Peringkat</th>
                <th class="text-left">Nama Alternatif</th>
                <th>D+ (Jarak Positif)</th>
                <th>D- (Jarak Negatif)</th>
                <th>Nilai Preferensi (V)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preferences as $index => $pref)
                <tr class="{{ $index == 0 ? 'bg-gray highlight' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $pref['alternatif']->objek->nama ?? 'Alt ' . $pref['alternatif']->id }}
                    </td>
                    <td>{{ number_format($distancePositive[$pref['alternatif']->id] ?? 0, 4) }}</td>
                    <td>{{ number_format($distanceNegative[$pref['alternatif']->id] ?? 0, 4) }}</td>
                    <td class="highlight">{{ number_format($pref['score'], 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Penjelasan --}}
    <div>
        <h2>Penjelasan</h2>
        <p>Berdasarkan perhitungan metode Topsis maka didapatkan bahwa
            <span
                class="text-red-highlight">{{ $preferences[0]['alternatif']->objek->nama ?? 'Alt ' . $preferences[0]['alternatif']->id }}</span>
            dengan nilai
            preferensi <span class="text-red-highlight">{{ number_format($preferences[0]['score'], 4) }}</span>
            merupakan
            kandidat terbaik dalam mendapatkan Bantuan Pangan Non Tunai (BPNT).
        </p>
        {{-- <p><strong>Ideal Positif:</strong></p>
        <ul>
            @foreach ($kriterias as $k)
                <li>{{ $k->nama }}: {{ number_format($idealPositive[$k->id], 4) }}</li>
            @endforeach
        </ul>
        <p><strong>Ideal Negatif:</strong></p>
        <ul>
            @foreach ($kriterias as $k)
                <li>{{ $k->nama }}: {{ number_format($idealNegative[$k->id], 4) }}</li>
            @endforeach
        </ul> --}}
    </div>

    <div style="margin-top: 30px; text-align: right; font-size: 11px;">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
    </div>

</body>

</html>
