<body>
    @foreach($response as $index => $item)
        <h4>{{$index + 1}}. {{$item['question']}}</h4>
        <form>
            <label><input type="radio"> 매우 그렇다</label>
            <label><input type="radio"> 그렇다</label>
            <label><input type="radio"> 그저 그렇다</label>
            <label><input type="radio"> 그렇지 않다</label>
            <label><input type="radio"> 전혀 그렇지 않다</label>
        </form>
    @endforeach
    <h3>건의사항</h3>
    <textarea></textarea>
    <div></div>
    <button>취소</button>
    <button>전송</button>
</body>
