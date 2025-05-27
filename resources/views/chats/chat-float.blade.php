<a href="{{ route('chats.index') }}"
   style="
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: rgba(255,125,0,0.86);
        color: white;
        border-radius: 50%;
        width: 70px;
        height: 70px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        transition: background-color 0.3s, transform 0.3s;
        border: 3px solid #fff;
   "
   title="Ir al chat"
   onmouseover="this.style.transform='scale(1.1)'"
   onmouseout="this.style.transform='scale(1)'">
    <i class="fas fa-comments"></i>
</a>
