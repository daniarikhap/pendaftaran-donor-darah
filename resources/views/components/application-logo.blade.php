<svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <defs>
        <linearGradient id="logoRedGrad" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#f43f5e" />
            <stop offset="100%" stop-color="#be123c" />
        </linearGradient>
        <filter id="logoGlow" x="-20%" y="-20%" width="140%" height="140%">
            <feDropShadow dx="0" dy="3" stdDeviation="4" flood-color="#f43f5e" flood-opacity="0.4"/>
        </filter>
    </defs>
    
    <!-- Heart outline -->
    <path d="M 50 85 C 50 85 15 55 15 35 C 15 20 28 10 42 15 C 47 17 50 22 50 22 C 50 22 53 17 58 15 C 72 10 85 20 85 35 C 85 55 50 85 50 85 Z" 
          fill="none" 
          stroke="url(#logoRedGrad)" 
          stroke-width="5" 
          stroke-linecap="round" 
          stroke-linejoin="round" />
          
    <!-- Blood droplet in center -->
    <path d="M 50 25 C 50 25 68 53 68 65 C 68 75 60 83 50 83 C 40 83 32 75 32 65 C 32 53 50 25 50 25 Z" 
          fill="url(#logoRedGrad)" 
          filter="url(#logoGlow)" />
          
    <!-- Pulse Line overlaying the droplet -->
    <path d="M 38 65 L 44 65 L 47 53 L 50 74 L 53 60 L 56 67 L 58 65 L 62 65" 
          fill="none" 
          stroke="#ffffff" 
          stroke-width="2.5" 
          stroke-linecap="round" 
          stroke-linejoin="round" />
</svg>
