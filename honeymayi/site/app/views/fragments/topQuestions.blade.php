@if (count($topQuestions) == 0)
<p>
    You have never asked a question. :(
</p>
@else
<table class="table text-left">
    <tr>
        <th>Honey May I...</th>
        <th>Times Asked</th>
        <th>Stats</th>
        <th>Actions</th>
    </tr>
    @foreach ($topQuestions as $question)
    <tr>
        <td>
            <a href="{{ URL::route('questions.show', ['question' => $question->id]) }}">
                {{ $question->question }}
            </a>
        </td>
        <td>{{ $question->times_asked }}</td>
        <td>
                        <span class="statYes">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                            {{ $question->personalYesAnswerCountAsDecimal(Auth::user())*100 }}%
                        </span><br />
                        <span class="statNo">
                            <span class="glyphicon glyphicon-thumbs-down"></span>
                            {{ $question->personalNoAnswerCountAsDecimal(Auth::user())*100 }}%
                        </span>
        </td>
        <td>
            <a href="{{ URL::route('questions.ask', ['question' => $question->id]) }}">
                ASK
            </a>
        </td>
    </tr>
    @endforeach
</table>
@endif