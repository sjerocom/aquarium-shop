@props(['productAttributes'])

@if($productAttributes->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-slate-50 border-b border-slate-200">
            <h3 class="text-lg font-semibold text-gray-900">Eigenschaften</h3>
        </div>
        <div class="divide-y divide-slate-200">
            @foreach($productAttributes as $attribute)
                <div class="px-6 py-3 flex justify-between items-center hover:bg-slate-50">
                    <span class="text-sm font-medium text-slate-700">
                        @switch($attribute->key)
                            @case('light_requirement')
                                Lichtbedarf
                                @break
                            @case('growth_height')
                                Wuchshöhe
                                @break
                            @case('growth_speed')
                                Wachstumsgeschwindigkeit
                                @break
                            @case('co2_required')
                                CO₂ erforderlich
                                @break
                            @case('temperature_min')
                                Temperatur Min
                                @break
                            @case('temperature_max')
                                Temperatur Max
                                @break
                            @case('ph_min')
                                pH-Wert Min
                                @break
                            @case('ph_max')
                                pH-Wert Max
                                @break
                            @case('gh_min')
                                GH Min
                                @break
                            @case('gh_max')
                                GH Max
                                @break
                            @case('max_size')
                                Maximale Größe
                                @break
                            @case('difficulty')
                                Schwierigkeitsgrad
                                @break
                            @case('socialization')
                                Vergesellschaftung
                                @break
                            @default
                                {{ ucfirst($attribute->key) }}
                        @endswitch
                    </span>
                    <span class="text-sm text-gray-900 font-semibold">{{ $attribute->value }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endif
