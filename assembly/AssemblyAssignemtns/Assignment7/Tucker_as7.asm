INCLUDE Irvine32.inc
.386
; .model flat, stdcall
.stack 4096
FindLargest proto, ptrArray:PTR DWORD, sizeArr : DWORD
ExitProcess proto, dwExitCode:dword

.data
count = 6
array DWORD 30, 18, 20, -14, 99, 2
arrayLen DWORD 6
val1 DWORD 10
val2 DWORD 20
val3 DWORD 30
str1 BYTE "Largest = ", 0
str2 BYTE "added value = ", 0
.code
main PROC
INVOKE FindLargest, ADDR array, count

mov  edx, OFFSET str1
call WriteString
call WriteDec
call Crlf


push val1
push val2
push val3
call AddThree
mov  edx, OFFSET str2
call WriteString
call WriteDec
call Crlf
main ENDP

AddThree PROC
push ebp
mov ebp, esp
mov eax, [ebp + 16]
add eax, [ebp + 12]
add eax, [ebp + 8]
pop ebp
ret 12
AddThree ENDP

FindLargest PROC, ptrArray:PTR DWORD, sizeArr:DWORD
	push ecx
	push esi

	mov eax, 0
	mov esi, ptrArray
	mov ecx, sizeArr
	cmp ecx, 0
	jle L2

	L1 :		
		cmp eax, [esi]
		jge NC
		mov eax, [esi]
	NC:
		add esi, 4
		loop L1

	L2:
		pop esi
		pop ecx
		ret 

	FindLargest ENDP
END main