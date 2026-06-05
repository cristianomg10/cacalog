<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn', 'style' => 'background: linear-gradient(135deg, #ff6b35, #f7931e); color: white; border: none;']) }}>
    {{ $slot }}
</button>
