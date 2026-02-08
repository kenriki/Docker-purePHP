import sys
import io
from datetime import datetime # 時間を扱うモジュール

# 出力をUTF-8に固定（日本語を使うため）
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

# 現在時刻を取得してフォーマット
now = datetime.now()
time_str = now.strftime("%Y/%m/%d %H:%M:%S")

print(f"Pythonが取得した時間: {time_str}")
print("このメッセージもPHPに届きます")