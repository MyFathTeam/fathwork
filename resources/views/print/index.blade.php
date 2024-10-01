<x-print.layout>
    {{-- <div class="no-print">
        <input type="text" v-model="title" />
        <input type="text" v-model="subTitle" />
    </div> --}}

    <h1 v-if="title" class="heading" v-text="title"></h1>
    <h1 v-if="subTitle" class="sub-heading" v-text="subTitle"></h1>
    <table class="table">
        <thead>
            <tr>
                @foreach($headers as $header)
                <th>{{$header}}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    @foreach($row as $item)
                    <td>
                        @if (is_array($item) && Arr::get($item, 'label'))
                            <div>{{Arr::get($item, 'label')}}</div>
                            <span class="block font-90pc">{{Arr::get($item, 'sub_label')}}</span>
                        @else
                            {{$item}}
                        @endif
                    </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
        @if($footer)
            <tfoot>
                <tr>
                    @foreach($footers as $footer)
                    <th>{{$footer}}</th>
                    @endforeach
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="footer">
        <p class="timestamp" v-if="timestamp">{{Cal::dateTime(now())->formatted}}</p>
    </div>
</x-print.layout>

<script>
    const { createApp } = Vue

    createApp({
      data() {
        return {
          title: "{{Arr::get($meta, 'title')}}",
          subTitle: "{{Arr::get($meta, 'sub_title')}}",
          timestamp: "{{Arr::get($meta, 'timestamp') ? 1 : 0}}",
        }
      }
    }).mount('#app')
  </script>