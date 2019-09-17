INCLUDE Irvine32.inc
start = 1
NumLoop = 8
.data

chars BYTE 'H', 'A', 'C', 'E', 'B', 'D', 'F', 'G'
links DWORD 0, 4, 5, 6, 2, 3, 7, 0
array BYTE 0, 0, 0, 0, 0, 0, 0, 0

.code
main PROC

mov dl, chars + 1	; move A from char array into dl
mov array, dl		; Move value of dl into our new array
mov esi, start		; set the first value of our counter to the start value
mov ebx, offset links


L1 :
mov eax, [ebx + esi * 4]
mov dl, chars[eax]
mov array[esi], dl
inc esi
add eax, 0
jnz L1

invoke ExitProcess, 0
main ENDP
END main