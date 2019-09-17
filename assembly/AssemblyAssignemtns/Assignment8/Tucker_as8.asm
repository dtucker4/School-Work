INCLUDE Irvine32.inc
.386
; .model flat, stdcall
.stack 4096
Str_lcase PROTO, pString:PTR BYTE

BubbleSort PROTO, pArray : PTR DWORD, Count : DWORD
PrintArray PROTO, pArray : PTR DWORD, count : DWORD
BinarySearch PROTO, pArray : PTR DWORD,	Count:DWORD,searchVal : DWORD
ExitProcess proto, dwExitCode:dword

.data
str1 BYTE "test 123 TOLOWER", 0
string_2 BYTE "aB234cdEfg", 0
arrCount DWORD 6
array DWORD 30, 8, 20, 1, 99, 2
array2 DWORD 1, 2, 3, 4, 5, 6
searchValue DWORD 7
.code
main PROC
	call Clrscr	
	INVOKE Str_lcase, ADDR str1
	mov  edx, OFFSET str1
	call WriteString
	call Crlf

	INVOKE PrintArray, ADDR array, arrCount
	INVOKE BubbleSort, ADDR array, arrCount
	INVOKE PrintArray, ADDR array, arrCount

	call AskForSearchVal
	INVOKE BinarySearch, ADDR array, arrCount, eax
	call ShowResults
exit
main ENDP

Str_lcase PROC USES eax esi,
pSTring: PTR BYTE

	mov esi, pString
	L1:
		mov al, [esi]
		cmp al, 0
		je L3
		cmp al, 'A'
		jb L2
		cmp al, 'Z'
		ja L2
		OR BYTE PTR [esi],00100000b
	L2:
		inc esi
		jmp L1
	L3: 
		ret
str_lcase ENDP


BubbleSort PROC USES eax ecx esi, pArray : PTR DWORD, count : DWORD
			LOCAL exf:DWORD
			mov ecx, count
			dec ecx
		L1:
			push ecx
			mov esi, pArray
			mov exf, 0
		L2: 
			mov eax, [esi]
			cmp[esi + 4], eax
			jg L3
			xchg eax, [esi + 4]
			mov[esi], eax
			mov exf, 1
		L3:
			add esi, 4
				loop L2
				cmp exf, 1
				jne L4
				pop ecx
				loop L1
				L4 : ret
		BubbleSort ENDP


		BinarySearch PROC USES ebx ecx edx esi edi,
				pArray : PTR DWORD, Count : DWORD, searchVal : DWORD
				
			; ---------------------------
			;ebx = first, ecx = last, edx = mid
			;--------------------------
				mov ebx, 0
				mov ecx, Count
				dec ecx

				L1 : cmp ebx, ecx
				jg L5

				mov edx, ecx
				add edx, ebx
				shr edx, 1	;edx=mid
			
				mov esi, pArray
				mov eax, [esi + edx * 4]

				cmp eax, searchVal
					jge L2
					mov ebx, edx
					inc ebx
					jmp L1
				L2:
					cmp eax, searchVal
					jle L3
					mov ecx, edx
					dec ecx
					jmp L1
				L3 : mov eax, edx
					jmp L9
				L5 : mov eax, -1
				L9 : ret

BinarySearch ENDP

PrintArray PROC USES eax ecx edx esi,
pArray : PTR DWORD, count:DWORD
				.data
				comma BYTE ", ", 0
				.code
				mov	esi, pArray
				mov	ecx, Count
				cld

				L1 : lodsd
				call	WriteInt
				mov	edx, OFFSET comma
				call	Writestring
				loop	L1

				call	Crlf
				ret
				PrintArray ENDP

				
		ShowResults PROC
				.data
				msg1 BYTE "The value was not found.", 0
				msg2 BYTE "The value was found at position ", 0
				.code
				.IF eax == -1
				mov edx, OFFSET msg1
				call WriteString
				.ELSE
				mov edx, OFFSET msg2
				call WriteString

					call WriteDec
					.ENDIF
					call Crlf
					call Crlf
					ret
				
		ShowResults ENDP

					
	AskForSearchVal PROC
			.data
			prompt BYTE "Enter a signed decimal integer "
			BYTE "to find in the array: ", 0
			.code
			call Crlf
			mov  edx, OFFSET prompt
			call WriteString
			call ReadInt
			ret
	AskForSearchVal ENDP
END main
