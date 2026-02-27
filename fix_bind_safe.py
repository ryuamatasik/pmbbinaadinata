import re
import sys

def process_file(file_path):
    with open(file_path, "r", encoding="utf-8") as f:
        content = f.read()

    # Matches old('field')
    # \1 is the field name
    content = re.sub(
        r"old\(\s*'([^']+)'\s*\)", 
        lambda m: f"old('{m.group(1)}', $pendaftar->{m.group(1)} ?? '')", 
        content
    )

    # Matches old('field', 'default_value')
    # We must be careful not to eat the quotes.
    # Group 1 is field name: ([^']+)
    # Group 2 is default value string (including inner content but avoiding eating the quotes if we capture them)
    # Let's say we capture the content INSIDE the quotes for the default value:
    # r"old\(\s*'([^']+)'\s*,\s*'([^']+)'\s*\)"
    content = re.sub(
        r"old\(\s*'([^']+)'\s*,\s*'([^']+)'\s*\)", 
        lambda m: f"old('{m.group(1)}', $pendaftar->{m.group(1)} ?? '{m.group(2)}')", 
        content
    )

    with open(file_path, "w", encoding="utf-8") as f:
        f.write(content)
    print(f"Updated {file_path}")

files = [
    "c:/xampp/htdocs/pmbbinaadinata/resources/views/mahasiswa/pendaftaran.blade.php",
    "c:/xampp/htdocs/pmbbinaadinata/resources/views/mahasiswa/partials/modal-keluarga.blade.php"
]

for file_path in files:
    process_file(file_path)

