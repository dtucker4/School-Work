#include "assign1.h"

int main(void) {
	STACK* stack;
	FILE *fp;
	int intArray[10];
	int* dataPtr;
	bool done = false;
	
	if ((fp = fopen("part2.txt", "r+")) == NULL) {
		puts("error opening file");
	}
	else {
		stack = stackCreate();
		for (int i = 0; i < 10; i++) {
			if ((fscanf(fp, "%d", &intArray[i]) == EOF || stackFull(stack)))
				done = true;
			else
				printf("Added : %d\n", intArray[i]);
				stackPush(stack, intArray[i]);
		}

		while (!stackEmpty(stack)) {
			dataPtr = (int*)stackPop(stack);
			printf("%d\n", dataPtr);
		}
		fclose(fp);
	}
	system("pause");
	return 0;
}