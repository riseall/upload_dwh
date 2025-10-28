<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted" => ":Attribute harus diterima.",
    "accepted_if" => ":Attribute harus diterima ketika :other berisi :value.",
    "active_url" => ":Attribute bukan URL yang valid.",
    "after" => ":Attribute harus berisi tanggal setelah :date.",
    "after_or_equal" => ":Attribute harus berisi tanggal setelah atau sama dengan :date.",
    "alpha" => ":Attribute hanya boleh berisi huruf.",
    "alpha_dash" => ":Attribute hanya boleh berisi huruf, angka, strip, dan garis bawah.",
    "alpha_num" => ":Attribute hanya boleh berisi huruf dan angka.",
    "any_of" => "Bidang :attribute tidak valid.",
    "array" => ":Attribute harus berisi sebuah array.",
    "ascii" => ":Attribute hanya boleh berisi karakter dan simbol alfanumerik single-byte.",
    "attached" => ":Attribute sudah dilampirkan.",
    "before" => ":Attribute harus berisi tanggal sebelum :date.",
    "before_or_equal" => ":Attribute harus berisi tanggal sebelum atau sama dengan :date.",
    "between.array" => ":Attribute harus memiliki :min sampai :max anggota.",
    "between.file" => ":Attribute harus berukuran antara :min sampai :max kilobita.",
    "between.numeric" => ":Attribute harus bernilai antara :min sampai :max.",
    "between.string" => ":Attribute harus berisi antara :min sampai :max karakter.",
    "boolean" => ":Attribute harus bernilai true atau false",
    "can" => "Bidang :attribute berisi nilai yang tidak sah.",
    "confirmed" => "Konfirmasi :attribute tidak cocok.",
    "contains" => "Bidang :attribute tidak memiliki nilai yang diperlukan.",
    "current_password" => "Kata sandi salah.",
    "date" => ":Attribute bukan tanggal yang valid.",
    "date_equals" => ":Attribute harus berisi tanggal yang sama dengan :date.",
    "date_format" => ":Attribute tidak cocok dengan format :format.",
    "decimal" => ":Attribute harus memiliki :decimal tempat desimal.",
    "declined" => ":Attribute ini harus ditolak.",
    "declined_if" => ":Attribute ini harus ditolak ketika :other bernilai :value.",
    "different" => ":Attribute dan :other harus berbeda.",
    "digits" => ":Attribute harus terdiri dari :digits angka.",
    "digits_between" => ":Attribute harus terdiri dari :min sampai :max angka.",
    "dimensions" => ":Attribute tidak memiliki dimensi gambar yang valid.",
    "distinct" => ":Attribute memiliki nilai yang duplikat.",
    "doesnt_contain" => "Bidang :attribute tidak boleh berisi salah satu dari yang berikut: :values.",
    "doesnt_end_with" => ":Attribute tidak boleh diakhiri dengan salah satu dari berikut ini: :values.",
    "doesnt_start_with" => ":Attribute tidak boleh dimulai dengan salah satu dari berikut ini: :values.",
    "email" => ":Attribute harus berupa alamat surel yang valid.",
    "ends_with" => ":Attribute harus diakhiri salah satu dari berikut: :values",
    "enum" => ":Attribute yang dipilih tidak valid.",
    "exists" => ":Attribute yang dipilih tidak valid.",
    "extensions" => "Bidang :attribute harus memiliki salah satu ekstensi berikut: :values.",
    "file" => ":Attribute harus berupa sebuah berkas.",
    "filled" => ":Attribute harus memiliki nilai.",
    "gt.array" => ":Attribute harus memiliki lebih dari :value anggota.",
    "gt.file" => ":Attribute harus berukuran lebih besar dari :value kilobita.",
    "gt.numeric" => ":Attribute harus bernilai lebih besar dari :value.",
    "gt.string" => ":Attribute harus berisi lebih besar dari :value karakter.",
    "gte.array" => ":Attribute harus terdiri dari :value anggota atau lebih.",
    "gte.file" => ":Attribute harus berukuran lebih besar dari atau sama dengan :value kilobita.",
    "gte.numeric" => ":Attribute harus bernilai lebih besar dari atau sama dengan :value.",
    "gte.string" => ":Attribute harus berisi lebih besar dari atau sama dengan :value karakter.",
    "hex_color" => "Bidang :attribute harus berupa warna heksadesimal yang valid.",
    "image" => ":Attribute harus berupa gambar.",
    "in" => ":Attribute yang dipilih tidak valid.",
    "in_array" => ":Attribute tidak ada di dalam :other.",
    "in_array_keys" => ":attribute bidang harus berisi setidaknya satu dari tombol berikut: :values.",
    "integer" => ":Attribute harus berupa bilangan bulat.",
    "ip" => ":Attribute harus berupa alamat IP yang valid.",
    "ipv4" => ":Attribute harus berupa alamat IPv4 yang valid.",
    "ipv6" => ":Attribute harus berupa alamat IPv6 yang valid.",
    "json" => ":Attribute harus berupa JSON string yang valid.",
    "list" => "Bidang :attribute harus berupa daftar.",
    "lowercase" => ":Attribute harus berupa huruf kecil.",
    "lt.array" => ":Attribute harus memiliki kurang dari :value anggota.",
    "lt.file" => ":Attribute harus berukuran kurang dari :value kilobita.",
    "lt.numeric" => ":Attribute harus bernilai kurang dari :value.",
    "lt.string" => ":Attribute harus berisi kurang dari :value karakter.",
    "lte.array" => ":Attribute harus tidak lebih dari :value anggota.",
    "lte.file" => ":Attribute harus berukuran kurang dari atau sama dengan :value kilobita.",
    "lte.numeric" => ":Attribute harus bernilai kurang dari atau sama dengan :value.",
    "lte.string" => ":Attribute harus berisi kurang dari atau sama dengan :value karakter.",
    "mac_address" => ":Attribute harus berupa alamat MAC yang valid.",
    "max.array" => ":Attribute maksimal terdiri dari :max anggota.",
    "max.file" => ":Attribute maksimal berukuran :max kilobita.",
    "max.numeric" => ":Attribute maksimal bernilai :max.",
    "max.string" => ":Attribute maksimal berisi :max karakter.",
    "max_digits" => ":Attribute tidak boleh memiliki lebih dari :max digit.",
    "mimes" => ":Attribute harus berupa berkas berjenis: :values.",
    "mimetypes" => ":Attribute harus berupa berkas berjenis: :values.",
    "min.array" => ":Attribute minimal terdiri dari :min anggota.",
    "min.file" => ":Attribute minimal berukuran :min kilobita.",
    "min.numeric" => ":Attribute minimal bernilai :min.",
    "min.string" => ":Attribute minimal berisi :min karakter.",
    "min_digits" => ":Attribute tidak boleh memiliki kurang dari :min digit.",
    "missing" => "Bidang :attribute harus hilang.",
    "missing_if" => "Bidang :attribute harus hilang ketika :other adalah :value.",
    "missing_unless" => "Bidang :attribute harus hilang kecuali :other adalah :value.",
    "missing_with" => "Kolom :attribute harus hilang saat ada :values.",
    "missing_with_all" => "Kolom :attribute harus hilang jika ada :values.",
    "multiple_of" => ":Attribute harus merupakan kelipatan dari :value",
    "next" => "Berikutnya &raquo;",
    "not_in" => ":Attribute yang dipilih tidak valid.",
    "not_regex" => "Format :attribute tidak valid.",
    "numeric" => ":Attribute harus berupa angka.",
    "password" => "Kata sandi salah.",
    "password.letters" => ":Attribute ini harus memiliki setidaknya satu karakter.",
    "password.mixed" => ":Attribute ini harus memiliki setidaknya satu huruf kapital dan satu huruf kecil.",
    "password.numbers" => ":Attribute ini harus memiliki setidaknya satu angka.",
    "password.symbols" => ":Attribute ini harus memiliki setidaknya satu simbol.",
    "password.uncompromised" => ":Attribute ini telah muncul di kebocoran data. Silahkan memilih :attribute yang berbeda.",
    "present" => ":Attribute wajib ada.",
    "present_if" => "Bidang :attribute harus ada ketika :other adalah :value.",
    "present_unless" => "Bidang :attribute harus ada kecuali :other adalah :value.",
    "present_with" => "Bidang :attribute harus ada bila ada :values.",
    "present_with_all" => "Bidang :attribute harus ada ketika ada :values.",
    "previous" => "&laquo; Sebelumnya",
    "prohibited" => ":Attribute tidak boleh ada.",
    "prohibited_if" => ":Attribute tidak boleh ada bila :other adalah :value.",
    "prohibited_if_accepted" => ":attribute bidang dilarang ketika :other diterima.",
    "prohibited_if_declined" => ":attribute bidang dilarang ketika :other ditolak.",
    "prohibited_unless" => ":Attribute tidak boleh ada kecuali :other memiliki nilai :values.",
    "prohibits" => ":Attribute melarang isian :other untuk ditampilkan.",
    "regex" => "Format :attribute tidak valid.",
    "relatable" => ":Attribute ini mungkin tidak berasosiasi dengan sumber ini.",
    "required" => ":Attribute wajib diisi.",
    "required_array_keys" => ":Attribute wajib berisi entri untuk: :values.",
    "required_if" => ":Attribute wajib diisi bila :other adalah :value.",
    "required_if_accepted" => ":Attribute wajib diisi bila :other sesuai.",
    "required_if_declined" => "Bidang :attribute wajib diisi bila :other ditolak.",
    "required_unless" => ":Attribute wajib diisi kecuali :other memiliki nilai :values.",
    "required_with" => ":Attribute wajib diisi bila terdapat :values.",
    "required_with_all" => ":Attribute wajib diisi bila terdapat :values.",
    "required_without" => ":Attribute wajib diisi bila tidak terdapat :values.",
    "required_without_all" => ":Attribute wajib diisi bila sama sekali tidak terdapat :values.",
    "same" => ":Attribute dan :other harus sama.",
    "size.array" => ":Attribute harus mengandung :size anggota.",
    "size.file" => ":Attribute harus berukuran :size kilobyte.",
    "size.numeric" => ":Attribute harus berukuran :size.",
    "size.string" => ":Attribute harus berukuran :size karakter.",
    "starts_with" => ":Attribute harus diawali salah satu dari berikut: :values",
    "string" => ":Attribute harus berupa string.",
    "timezone" => ":Attribute harus berisi zona waktu yang valid.",
    "ulid" => ":Attribute harus merupakan ULID yang valid.",
    "unique" => ":Attribute sudah ada sebelumnya.",
    "uploaded" => ":Attribute gagal diunggah.",
    "uppercase" => ":Attribute harus berupa huruf kapital.",
    "url" => "Format :attribute tidak valid.",
    "uuid" => ":Attribute harus merupakan UUID yang valid.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'g-recaptcha-response' => [
            'required' => 'Silakan konfirmasi bahwa anda bukan robot.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
