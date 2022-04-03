<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center tracking-widest btn btn-success btn-color-dafault']) }}>
    {{ $slot }}
</button>
